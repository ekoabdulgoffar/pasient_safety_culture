<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tr_respon;
use App\Models\Dt_drespon;
use App\Models\Ms_skor;

class ResponseController extends Controller
{
  function getMapsData(){

    $data = [];
    // $format = [
    //   'asdasd' => asdasd,

    // ]
    // ambil data respon seluruhnya
    $data_responses = Tr_respon::join('ms_user', 'ms_user.user_id', '=', 'tr_respon.user_id')
      ->join('ms_rw', 'ms_rw.rw_id', '=', 'ms_user.rw_id')
      ->join('ms_kelurahan', 'ms_kelurahan.kelurahan_id', '=', 'ms_rw.kelurahan_id')
			->join('ms_kecamatan', 'ms_kecamatan.kecamatan_id', '=', 'ms_kelurahan.kecamatan_id')
      ->get();

    // data ms skor
    // $skors = Ms_skor::orderBy('skor_id', 'desc')->get();

    // return response()->json($data_responses);
    $lat = -6.147810;
    $lng = 106.796520;

    foreach($data_responses as $data_response){

      $hasil = $this->getHasilResponse($data_response['respon_id']);
      

      // $data_details = Dt_drespon::where('respon_id', )->get();
      // $hasil = 0;
      // // perhitungan nilai
      // foreach($data_details as $data_detail){
      //   if($data_detail['drespon_jawaban'] != 0){
      //     $hasil++;
      //   }
      // }
      // $hasil = $hasil / count($data_details) * 100;

      // penetapan status

      // $status = '';
      // $icon = '';

      $skor = $this->getSkorByHasil($hasil);

      // foreach($skors as $skor){
      //   if($hasil <= $skor['skor_max']){
      //     $status = $skor['skor_deskripsi'];
      //     $icon = $skor['skor_icon'];
      //   }
      // }

      $format = [
        'respon_id' => $data_response['respon_id'],
        'kecamatan' => $data_response['kecamatan_nama'],
        'kelurahan' => $data_response['kelurahan_nama'],
        'rw' => $data_response['rw_'],
        'lat' => $lat,
        'lng' => $lng,
        'skor' => $hasil,
        'status' => $skor['skor_deskripsi'],
        'icon' => $skor['skor_icon'],
      ];
      
      $lat = $lat + 0.00143;
      $lng = $lng + 0.00161;
      array_push($data, $format);
    }
    
    return response()->json($data);
  }
}