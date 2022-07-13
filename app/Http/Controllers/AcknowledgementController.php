<?php

namespace App\Http\Controllers;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Ms_file_edukasi;

class AcknowledgementController extends Controller
{
	public function index()
	{
		if (!session()->has('user_id')) {
			return redirect('login');
		} else if (session()->has('user_role') == true && session('user_role') == "Admin" && session('user_role') == "Dokter Gigi") {
			return abort(404);
		}
		
		$data_file = Ms_file_edukasi::where([
					['edu_category', '=', 'Acknowledgements']
				])->orderBy('edu_id', 'DESC')->first(); // video ucapan terima kasih
		
		$title_video = "";
		$link_video = "";
		$title_pdf = "";
		$link_pdf = "";
		
		$title_video = $data_file['edu_desk_video'];
		$link_video = $data_file['edu_file_video'];
		$title_pdf = $data_file['edu_desk_pdf'];
		$link_pdf = $data_file['edu_file_pdf'];
		
		$data['title_video'] = $title_video;
		$data['link_video'] = $link_video;
		$data['title_pdf'] = $title_pdf;
		$data['link_pdf'] = $link_pdf;
		return view('acknowledgements',$data);
	}
}
