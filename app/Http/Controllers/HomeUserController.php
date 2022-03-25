<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ms_kuesioner;
use App\Models\Tr_respon;

class HomeUserController extends Controller
{
    //
    function index(){
        $this->checkLogin();

        $data = [];
        return view('user_dashboard', $data);
    }

    function historyKuesioner(){
        $this->checkLogin();
        
        $data = [];        
        // get data kuesioner
        $data_kuesioners = Ms_kuesioner::get();    
        
        
        // return response()->json($aa);

        foreach($data_kuesioners as $data_kuesioner){
            
            // get data response        
            $data_responses = Tr_respon::join('ms_user', 'ms_user.user_id', '=', 'tr_respon.user_id')            
            ->where('ms_user.user_id',session('user_id'))
            ->get();           
            
            $data_response = [];

            for($index = 0; $index < count($data_responses); $index++){
                
                $kuesioner_diisi = $this->getKuesionerByResponId($data_responses[$index]['respon_id']);

                if($kuesioner_diisi['kuesioner_id'] == $data_kuesioner['kuesioner_id']){
                    $data_response = $data_responses[$index];
                    break;
                }
            }
            
            $hasil = 0;
            $skor = [];

            if($data_response){
                $hasil = $this->getHasilResponse($data_response['respon_id']);
                $skor =  $this->getSkorByHasil($hasil);
            }
            
            $format = [
                'kuesioner' => $data_kuesioner,
                'respon' => $data_response,
                'status' => $hasil > 0 ? 1 : 0,
                'hasil' => $data_response ? $hasil : '-',
                'risiko' => $data_response ? $skor['skor_deskripsi'] : '-',                
            ];

            array_push($data, $format);
        }
        
        $response['data'] = $data;
        // return response()->json($response);
        return view('user_kuesioner_history', $response);
    }

    
}
