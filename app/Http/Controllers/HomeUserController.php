<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tr_edukasi;
use App\Models\Ms_kuesioner;
use App\Models\Tr_respon;
use App\Models\Ms_kelompok_pertanyaan;
use App\Models\Dt_drespon;
use App\Models\Dt_dkuesioner;
use App\Models\Ms_pertanyaan;
use App\Models\Ms_skor;
use App\Models\Tr_respon_post;
use App\Models\Ms_post_test;
use App\Models\Dt_post_test;
use App\Models\Ms_pertanyaan_post;
use App\Models\Dt_respon_post;

class HomeUserController extends Controller
{
    //
    function index(){
        if (!session()->has('user_id')) {
			return redirect('login');
		};

        $pass = [];

        // get data response        
        $data_responses = Tr_respon::where('user_id',mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))
        ->get() ;
        
        // jika data response nya kosong, langsung masuk ke halaman kuesioner
        $id_kuesioner = myencrypt(Ms_kuesioner::first()['kuesioner_id'],"Pasientsafetyculture@2022");

        if(count($data_responses) == 0){
            return redirect('user-kuesioner/isi/'.$id_kuesioner);
        }

        // get kelompok
        $data = [];
        $kelompok = Ms_kelompok_pertanyaan::get();
        $data_response = $data_responses[count($data_responses) -1];
        
        $hasil = 0;
        $skor = [];
        $total_skor = 0;
        $jumlah_pertanyaan = 0;
            
        foreach ($kelompok as $k) {
            array_push($skor,0);
        }
        array_push($skor,0);

        $kuesioner = $this->getKuesionerByResponId($data_response['respon_id']);
        $jawaban = Dt_drespon::where('respon_id', $data_response['respon_id'])->get();
        
        foreach ($jawaban as $key => $j) {
            
            $dt_dkuesioner = Dt_dkuesioner::where('dkuesioner_id',$j['dkuesioner_id'])->first();
            $pertanyaan = Ms_pertanyaan::where('pertanyaan_id', $dt_dkuesioner['pertanyaan_id'])->first();
            foreach ($kelompok as $k) {
                if($pertanyaan['kelompok_pertanyaan_id'] == $k['kelompok_pertanyaan_id']){
                    $skor[$pertanyaan['kelompok_pertanyaan_id']]+=$j['drespon_jawaban'];
                    $total_skor+=$j['drespon_jawaban'];
                    $jumlah_pertanyaan++;
                    break;
                }                
            }                
        }
        $skor_mean = [];

        foreach ($skor as $key=>$s) {
            $jumlah = count(Ms_pertanyaan::where('kelompok_pertanyaan_id', $key)->get());
            if($jumlah != 0){
                array_push($skor_mean, $this->getMean($s, $jumlah));
            }else{
                array_push($skor_mean, -1);
            }            
        }
        // get last tr_edukasi
        $tr_edukasi = Tr_edukasi::where('user_id', mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))
        ->orderBy('datetime_update', 'desc')
        ->first();
        
        $format = [
            'kuesioner' => $this->getKuesionerByResponId($data_response['respon_id']),
            'edukasi' => $tr_edukasi,
            'respon' => $data_response,
            'total_skor' => $total_skor,
            'skor_mean' => $skor_mean,
            'mean_total_skor' => $this->getMean($total_skor,$jumlah_pertanyaan)
        ];

        $pass['data'] = $format;
        $pass['skor'] = Ms_skor::get();
        $pass['kelompok'] = $kelompok;
        return view('user_dashboard', $pass);
    }
}
