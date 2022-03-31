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

        // get data response        
        $data_responses = Tr_respon::where('user_id',mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))
        ->get() ;
        
        // jika data response nya kosong, langsung masuk ke halaman kuesioner
        $id_kuesioner = myencrypt(Ms_kuesioner::first()['kuesioner_id'],"Pasientsafetyculture@2022");

        if(count($data_responses) == 0){
            return redirect('user-kuesioner/isi/'.$id_kuesioner);
        }

        return view('user_dashboard', $data);
    }
}
