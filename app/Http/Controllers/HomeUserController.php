<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
                
                if($k['kelompok_pertanyaan_deskripsi'] != 'Pribadi'){
                    if($pertanyaan['kelompok_pertanyaan_id'] == $k['kelompok_pertanyaan_id']){
                        
                        $skor[$pertanyaan['kelompok_pertanyaan_id']]+=$j['drespon_jawaban'];
                        $total_skor+=$j['drespon_jawaban'];
                        $jumlah_pertanyaan++;
                        break;
                    }
                }
            }                
        }
        $skor_mean = [];

        foreach ($skor as $key=>$s) {
            // key 1 adalah kelompok pribadi, kita tidak butuh itu
            if($key!=1){
                $jumlah = count(Ms_pertanyaan::where('kelompok_pertanyaan_id', $key)->get());
                if($jumlah != 0){
                    array_push($skor_mean, $this->getMean($s, $jumlah));
                }else{
                    array_push($skor_mean, -1);
                }
            }
        }
        
        $format = [
            'kuesioner' => $this->getKuesionerByResponId($data_response['respon_id']),
            'respon' => $data_response,
            'total_skor' => $total_skor,
            'skor_mean' => $skor_mean,
            'mean_total_skor' => $this->getMean($total_skor,$jumlah_pertanyaan)
        ];

        // get data post test, apakah sudah menyelesaikan atau belum
        $last_post = Tr_respon_post::where('user_id', mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))
        ->orderBy('respon_post_datetime', 'desc')
        ->join('dt_respon_post', 'dt_respon_post.respon_post_id','=','tr_respon_post.respon_post_id')
        ->join('dt_post_test', 'dt_post_test.dtpost_test_id', '=', 'dt_respon_post.dtpost_test_id')
        ->join('ms_post_test','ms_post_test.post_test_id','=','dt_post_test.post_test_id')
        ->first();

        if($format['respon']['respon_datetime'] < $last_post['respon_post_datetime']){
            $pass['post_test'] = $last_post;
        }else{
            $pass['post_test'] = null;
        }

        // Get Last Post Test
        $pertanyaan = [];

        $ms_post_test = Ms_post_test::orderBy('post_test_datetime','desc')->first();
        $dt_post_test = Dt_post_test::where('post_test_id', $ms_post_test['post_test_id'])->get();
        
        foreach ($dt_post_test as $key => $dt) {
            $per = Ms_pertanyaan_post::where('pertanyaan_post_id', $dt['pertanyaan_post_id'])->first();
            array_push($pertanyaan,$per);
        }

        $benar = 0;
        foreach ($pertanyaan as $key => $p) {
            $detail = Dt_respon_post::where('respon_post_id', $last_post['respon_post_id'])
            ->join('dt_post_test', 'dt_post_test.dtpost_test_id', '=', 'dt_respon_post.dtpost_test_id')
            ->where('dt_post_test.pertanyaan_post_id', $p['pertanyaan_post_id'])
            ->first();

            if($detail['drespon_jawaban'] == $p['pertanyaan_post_kunci']){
                $benar++;
            }
        }

        $benar = $benar / count($pertanyaan) * 100;

        
        if($last_post != null){
            $last_post['nilai'] = $benar;
        }
        
        $pass['last_post'] = $last_post;
        $pass['data'] = $format;
        $pass['skor'] = Ms_skor::get();
        $pass['kelompok'] = $kelompok;
        
        // return $kelompok;
        // return $format;
        // return $last_post;
        return view('user_dashboard', $pass);
    }
}
