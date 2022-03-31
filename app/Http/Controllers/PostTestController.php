<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ms_post_test;
use App\Models\Dt_post_test;
use App\Models\Ms_pertanyaan_post;
use App\Models\Tr_respon_post;
use App\Models\Dt_respon_post;
use App\Models\Ms_file_edukasi;
use App\Models\Tr_edukasi;
use App\Models\Ms_skor;

class PostTestController extends Controller
{
    //
    function index(){
        if (!session()->has('user_id')) {
			return redirect('login');
		};

        $pass = [];
        $pertanyaan = [];

        $ms_post_test = Ms_post_test::orderBy('post_test_datetime','desc')->first();
        $dt_post_test = Dt_post_test::where('post_test_id', $ms_post_test['post_test_id'])->get();
        
        foreach ($dt_post_test as $key => $dt) {
            $per = Ms_pertanyaan_post::where('pertanyaan_post_id', $dt['pertanyaan_post_id'])->first();
            array_push($pertanyaan,$per);
        }

        $pass['post_test'] = $ms_post_test;
        $pass['pertanyaan'] = $pertanyaan;
        
        return view('user_post_test', $pass);
    }

    function submitPostTest(Request $request){
        if (!session()->has('user_id')) {
			return redirect('login');
		};
        date_default_timezone_set('Asia/Jakarta'); // set time jakarta

        $pertanyaan = [];

        $ms_post_test = Ms_post_test::orderBy('post_test_datetime','desc')->first();
        $dt_post_test = Dt_post_test::where('post_test_id', $ms_post_test['post_test_id'])->get();
        
        foreach ($dt_post_test as $key => $dt) {
            $per = Ms_pertanyaan_post::where('pertanyaan_post_id', $dt['pertanyaan_post_id'])->first();
            array_push($pertanyaan,$per);
        }

        $insert = [
            'user_id' => (int) mydecrypt(session('user_id'), "Pasientsafetyculture@2022"),
            'respon_post_status' => 0,
            'respon_post_datetime' => date("Y-m-d H:i:s")
        ];

        $tr_respon_post = Tr_respon_post::create($insert);

        $benar = 0;
        foreach ($pertanyaan as $key => $p) {
            $detail = [
                'respon_post_id' => $tr_respon_post['id'],
                'dtpost_test_id' => Dt_post_test::where('pertanyaan_post_id', $p['pertanyaan_post_id'])->first()['dtpost_test_id'],
                'drespon_jawaban' => $request['ans-' .$p['pertanyaan_post_id']]
            ];
            Dt_respon_post::create($detail);
            if($detail['drespon_jawaban'] == $p['pertanyaan_post_kunci']){
                $benar++;
            }
        }

        $benar = $benar / count($pertanyaan) * 100;
        $skor = Ms_skor::get();
        
        if($benar > $skor[1]['skor_max']){
            $res = Tr_respon_post::where('respon_post_id', $tr_respon_post['id'])
            ->update(
                [
                    'respon_post_status' => 1,
                    'respon_post_datetime' => date("Y-m-d H:i:s"),
                ]
            );
        }else{
            // update jadi seakan akan blm paham, agar journey nya berulang

            $tr_edukasi = Tr_edukasi::where('user_id', mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))
            ->orderBy('datetime_update','desc')
            ->first();

            $tr_edukasi['tr_edu_isPdf'] = 0;
            $tr_edukasi['tr_edu_isVideo'] = 0;
            $tr_edukasi['datetime_update'] = date('Y-m-d H:i:s');
            $tr_edukasi->save();
        }

        return redirect('post-test-result');
    }

    function showResult(){
        if (!session()->has('user_id')) {
			return redirect('login');
		};   
        
        $pertanyaan = [];

        $ms_post_test = Ms_post_test::orderBy('post_test_datetime','desc')->first();
        $dt_post_test = Dt_post_test::where('post_test_id', $ms_post_test['post_test_id'])->get();
        
        foreach ($dt_post_test as $key => $dt) {
            $per = Ms_pertanyaan_post::where('pertanyaan_post_id', $dt['pertanyaan_post_id'])->first();
            array_push($pertanyaan,$per);
        }

        $tr_respon_post = Tr_respon_post::where('user_id', mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))
        ->orderBy('respon_post_datetime', 'desc')
        ->first();

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

        return view('user_post_test_result', $pass);
    }
}
