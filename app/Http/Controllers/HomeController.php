<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ms_skor;

class HomeController extends Controller
{
    public function index()
    {
		if (!session()->has('user_id')) {
			return redirect('login');
		} else if (session()->has('user_role') == true && session('user_role') != "Admin" ) {
			return abort(404);
		}
		
		$data['skor'] = Ms_skor::get();

        return view('dashboard', $data);
    }
		
}