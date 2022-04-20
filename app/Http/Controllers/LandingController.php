<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ms_kuesioner;
use App\Models\Tr_respon;
use App\Models\Dt_drespon;
use App\Models\Dt_dkuesioner;
use App\Models\Users;
class LandingController extends Controller
{
    //
    function index(){
        $kuesioner = Ms_kuesioner::get();
        $respon = [];
        $pertanyaan = [];
        foreach ($kuesioner as $key => $k) {
            $temp = Tr_respon::join('dt_drespon','dt_drespon.respon_id','=','tr_respon.respon_id')
            ->join('dt_dkuesioner','dt_dkuesioner.dkuesioner_id','=','dt_drespon.dkuesioner_id')
            ->join('ms_kuesioner','ms_kuesioner.kuesioner_id','=', 'dt_dkuesioner.kuesioner_id')
            ->where('ms_kuesioner.kuesioner_id', $k['kuesioner_id'])            
            ->select('dt_drespon.respon_id')
            ->groupBy('dt_drespon.respon_id')
            ->get();
            
            array_push($respon, count($temp));

            $temp1 = Dt_dkuesioner::where('kuesioner_id', $k['kuesioner_id'])->get();
            array_push($pertanyaan, count($temp1));
        }
        
        $data = [];
        $data['kuesioner'] = $kuesioner;
        $data['respon'] = $respon;
        $data['pertanyaan'] = $pertanyaan;
        $data['responden'] = count(Users::where('user_role','User')->where('user_status',1)->get());
        return view('landingpage', $data);
    }
}
