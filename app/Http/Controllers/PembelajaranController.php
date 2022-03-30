<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ms_file_edukasi;
use App\Models\Tr_edukasi;

class PembelajaranController extends Controller
{
    //
    function index(){
        if (!session()->has('user_id')) {
			return redirect('login');
		};

        $pass = [];

        $edukasi = Tr_edukasi::where('user_id', mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))
        ->orderBy('datetime_update','desc')
        ->first();

        $file = Ms_file_edukasi::first();
        
        $pass['file'] = $file;
        $pass['edukasi'] = $edukasi;

        return view('user_pembelajaran', $pass);
    }

    function updatePembelajaran($id){
        if (!session()->has('user_id')) {
			return redirect('login');
		};

        $id = mydecrypt($id, "Pasientsafetyculture@2022");
        
        $edukasi = Tr_edukasi::where('user_id', mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))
        ->orderBy('datetime_update','desc')
        ->first();

        if($id == 1){
            $edukasi['tr_edu_isPdf'] = 1;
        }else{
            $edukasi['tr_edu_isVideo'] = 1;
        }

        $edukasi->save();
        
        return redirect('pembelajaran');
    }
}
