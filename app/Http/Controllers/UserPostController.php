<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tr_respon_post;
use App\Models\Ms_post_test;
use App\Models\Dt_post_test;
use App\Models\Dt_respon_post;
use App\Models\Ms_pertanyaan_post;
use App\Models\Ms_skor;

class UserPostController extends Controller
{
    //
    function index(){
        if (!session()->has('user_id')) {
			return redirect('login');
		}

        $pass = [];

        $post_test = Tr_respon_post::where('user_id',mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))
        ->get();

        $skor = Ms_skor::get();    

        $pertanyaan = [];

        $ms_post_test = Ms_post_test::orderBy('post_test_datetime','desc')->first();
        $dt_post_test = Dt_post_test::where('post_test_id', $ms_post_test['post_test_id'])->get();
        
        if(count($post_test) > 0){
            foreach ($dt_post_test as $key => $dt) {
                $per = Ms_pertanyaan_post::where('pertanyaan_post_id', $dt['pertanyaan_post_id'])->first();
                array_push($pertanyaan,$per);
            }
        }

        
        $post_test1 = [];
        foreach ($post_test as $respon) {
            $benar = 0;
            foreach ($pertanyaan as $key => $p) {
                $detail = Dt_respon_post::where('respon_post_id', $respon['respon_post_id'])
                ->join('dt_post_test', 'dt_post_test.dtpost_test_id', '=', 'dt_respon_post.dtpost_test_id')
                ->where('dt_post_test.pertanyaan_post_id', $p['pertanyaan_post_id'])
                ->first();
                
                if($detail['drespon_jawaban'] == $p['pertanyaan_post_kunci']){
                    $benar++;
                }
            }
            
            $benar = $benar / count($pertanyaan) * 100;
            $respon['nilai'] = $benar;
            $respon['respon_post_status'] = $benar > $skor[1]['skor_max'] ? 1 : 0;
            array_push($post_test1, $respon);
        }

        // return $post_test;
        $pass['post_test'] = $post_test1;

        return view('user_post_test_history', $pass);
    }

    function showResult($id){
        if (!session()->has('user_id')) {
			return redirect('login');
		};   
        
        $id = mydecrypt($id, "Pasientsafetyculture@2022");

        $pertanyaan = [];

        $ms_post_test = Ms_post_test::orderBy('post_test_datetime','desc')->first();
        $dt_post_test = Dt_post_test::where('post_test_id', $ms_post_test['post_test_id'])->get();
        
        foreach ($dt_post_test as $key => $dt) {
            $per = Ms_pertanyaan_post::where('pertanyaan_post_id', $dt['pertanyaan_post_id'])->first();
            array_push($pertanyaan,$per);
        }

        $tr_respon_post = Tr_respon_post::where('respon_post_id', $id)->first();

        $benar = 0;
        foreach ($pertanyaan as $key => $p) {
            $detail = Dt_respon_post::where('respon_post_id', $tr_respon_post['respon_post_id'])
            ->join('dt_post_test', 'dt_post_test.dtpost_test_id', '=', 'dt_respon_post.dtpost_test_id')
            ->where('dt_post_test.pertanyaan_post_id', $p['pertanyaan_post_id'])
            ->first();

            if($detail['drespon_jawaban'] == $p['pertanyaan_post_kunci']){
                $benar++;
            }
        }

        $benar = $benar / count($pertanyaan) * 100;
        $pass['nilai'] = $benar;
        $pass['history'] = true;

        return view('user_post_test_result', $pass);
    }
}
