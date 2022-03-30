<?php

namespace App\Http\Controllers;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Ms_file_edukasi;

class EdukasiController extends Controller
{
	public function index()
	{
		if (!session()->has('user_id')) {
			return redirect('login');
		} else if (session()->has('user_role') == true && session('user_role') != "Admin" ) {
			return abort(404);
		}
		
		$data['ms_file_edukasi'] = Ms_file_edukasi::All();
		return view('management_of_education',$data);
	}

	public function insert_education(Request $request)
	{
		date_default_timezone_set('Asia/Jakarta'); // set time jakarta
		$today = date("Y-m-d H:i:s");
		
		$crud_result = 0;
		$crud_message = '';
		
		$edu_desk_pdf = $request->input("edu_desk_pdf");
		$edu_file_pdf = $request->input("edu_file_pdf");
		$edu_desk_video = $request->input("edu_desk_video");
		$edu_file_video = $request->input("edu_file_video");
		
		$data = array(
				'edu_desk_pdf' => $edu_desk_pdf,
				'edu_file_pdf' => $edu_file_pdf,
				'edu_desk_video' => $edu_desk_video,
				'edu_file_video' => $edu_file_video,
			);
		$result = Ms_file_edukasi::insert($data);
		
		if ($result > 0) {
			$crud_result = 1;
			$crud_message = 'Data has been added.';
		}  else {$crud_message = 'Failed to add data.';}
		
		$data['crud_result'] = $crud_result;
		$data['crud_message'] = $crud_message;
		
		$data['ms_file_edukasi'] = Ms_file_edukasi::All();
		return view('management_of_education',$data);
	}
	
	public function update_education(Request $request)
	{
		date_default_timezone_set('Asia/Jakarta'); // set time jakarta
		$today = date("Y-m-d H:i:s");
		
		$crud_result = 0;
		$crud_message = '';
		
		$edu_desk_pdf = $request->input("edu_desk_pdf_update");
		$edu_file_pdf = $request->input("edu_file_pdf_update");
		$edu_desk_video = $request->input("edu_desk_video_update");
		$edu_file_video = $request->input("edu_file_video_update");
		
		$data = array(
				'edu_desk_pdf' => $edu_desk_pdf,
				'edu_file_pdf' => $edu_file_pdf,
				'edu_desk_video' => $edu_desk_video,
				'edu_file_video' => $edu_file_video,
			);
		$result = Ms_file_edukasi::where([
					['edu_id', '=', $request->input('id_update')]
				])->update($data);
				
		if ($result > 0) {
			$crud_result = 1;
			$crud_message = 'Data has been updated.';
		}  else {$crud_message = 'Failed to update data.';}
		
		$data['crud_result'] = $crud_result;
		$data['crud_message'] = $crud_message;
		
		$data['ms_file_edukasi'] = Ms_file_edukasi::All();
		return view('management_of_education',$data);
	}
	
	public function delete_education(Request $request)
    {
		$result = Ms_file_edukasi::where([
				['edu_id', '=', $request->input('id_delete')]
			])->delete();
		$crud_result = 0;
		$crud_message = '';
		if ($result > 0) {
			$crud_result = 1;
			$crud_message = 'Data has been deleted.';
		}  else {$crud_message = 'Failed to delete data.';}
		
		$data['crud_result'] = $crud_result;
		$data['crud_message'] = $crud_message;
		
		$data['ms_file_edukasi'] = Ms_file_edukasi::All();
		return view('management_of_education',$data);
    }
	
}
