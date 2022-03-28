<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ms_kuesioner;
use App\Models\Tr_respon;

class HomeUserController extends Controller
{
    //
    function index(){
        if (!session()->has('user_id')) {
			return redirect('login');
		};

        $data = [];
        return view('user_dashboard', $data);
    }
}
