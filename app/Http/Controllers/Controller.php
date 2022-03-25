<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Dt_drespon;
use App\Models\Dt_dkuesioner;
use App\Models\Tr_drespon;
use App\Models\Ms_kuesioner;
use App\Models\Ms_skor;
use App\Models\Ms_pertanyaan;
use App\Models\Ms_jenis_pertanyaan;
use App\Models\Ms_kelompok_pertanyaan;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function checkLogin(){
        if (!session()->has('user_id')) {
			//return redirect('login');
		}
        //  else if (session()->has('user_role') == true && session('user_role') != "Admin" ) {
		// 	return abort(404);
		// }
    }

    function getHasilResponse($respon_id){
        $data_details = Dt_drespon::where('respon_id', $respon_id)->get();
        $hasil = 0;
        // perhitungan nilai
        foreach($data_details as $data_detail){
            if($data_detail['drespon_jawaban'] != -1){
                $hasil++;
            }
        }
        $hasil = $hasil / count($data_details) * 100;
        return $hasil;
    }

    function getSkorByHasil($hasil){
        // data ms skor
        $skors = Ms_skor::orderBy('skor_id', 'desc')->get();

        $output;
        foreach($skors as $skor){
            if($hasil <= $skor['skor_max']){
                $output = $skor;
            }
        }

        return $output;
    }

    function getKuesionerByResponId($respon_id){
        $data = Dt_drespon::where('respon_id', $respon_id)->first();
        $data = Dt_dkuesioner::where('dkuesioner_id', $data['dkuesioner_id'])->first();
        $data = Ms_kuesioner::where('kuesioner_id', $data['kuesioner_id'])->first();

        return $data;
    }

    function getListPertanyaanByKuesionerId($kuesioner_id){
        $data = Dt_dkuesioner::where('kuesioner_id', $kuesioner_id)->get();
        $pertanyaan = [];
        foreach($data as $d){
            array_push( $pertanyaan, Ms_pertanyaan::where('pertanyaan_id', $d['pertanyaan_id'])->first());
        }
        return $pertanyaan;
    }

    // JENIS PERTANYAAN
    function getJenisPertanyaanById($jenis_pertanyaan_id){
        $data = Ms_jenis_pertanyaan::where('jenis_pertanyaan_id', $jenis_pertanyaan_id)->first();
        return $data;
    }
    function getListJenisPertanyaan(){
        return Ms_jenis_pertanyaan::get();
    }
    // END JENIS PERTANYAAN

    // KELOMPOK PERTANYAAN
    function getListKelompokPertanyaan(){
        return Ms_kelompok_pertanyaan::get();
    }

    function getKelompokPertanyaanById($kelompok_pertanyaan_id){
        return Ms_kelompok_pertanyaan::where('kelompok_pertanyaan_id', $kelompok_pertanyaan_id)->first();
    }
    // END KELOMPOK PERTANYAAN
}
