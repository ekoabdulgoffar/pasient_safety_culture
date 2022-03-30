<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ms_post_test;
use App\Models\Dt_post_test;
use App\Models\Ms_pertanyaan_post;

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
}
