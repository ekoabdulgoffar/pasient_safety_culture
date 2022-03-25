<?php

namespace App\Http\Controllers;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Users;

class UserController extends Controller
{
	public function index()
	{
		if (!session()->has('user_id')) {
			return redirect('login');
		} else if (session()->has('user_role') == true && session('user_role') != "Admin" ) {
			return abort(404);
		}
		$data['ep_user'] = Users::All();
		return view('management_of_user',$data);
	}
	
    public function updatePassword(Request $request)
    {
		$data = Users::where([
				['user_id', '=', session('user_id')],
				['user_status', '=', '1']
			])->first();

		$data_user = Users::
            where([
				['user_id', '=', session('user_id')]
			])->first();
		
		$user_password = $data_user->user_password;
		$data['user_password'] = $user_password;
			
		$db_password_old="";
		if ($data != null) 
		{
			$db_password_old = $data->user_password;
		}
		
		$crud_result = 0;
		$crud_message = '';
		if ($db_password_old == myencrypt($request->input('password_old'), "EduriskPayment2022!")) {
			if($request->input('password_new') == $request->input('password_confirm')) {
				$result = Users::where([
							['user_id', '=', session('user_id')],
							['user_status', '=', '1']
						])->update(['user_password' => myencrypt($request->input('password_new'), "EduriskPayment2022!")]);
				
				if ($result > 0) {
					$crud_result = 1;
					$crud_message = 'Data has been updated.';
				}  else {$crud_message = 'Failed to update data.';}
			} else { 
				$crud_message = 'Failed to update data.';
			}
		} else {
			$crud_message = 'Old Password incorrect.';
		}
		$data['crud_result'] = $crud_result;
		$data['crud_message'] = $crud_message;
		
		if (session('user_role') == 'Admin') echo view('dashboard', $data);
		else if (session('user_role') == 'User') echo view('home_user', $data);
    }
	
	public function resetPassword(Request $request)
    {
		$user_id = $request->input('user_id_reset');
		$password_new = $request->input('password_new_reset');
		$password_confirm = $request->input('password_confirm_reset');
		
		$crud_result = 0;
		$crud_message = '';
		if($password_new == $password_confirm) {
			$result = Users::where([
						['user_id', '=', $user_id]
					])->update(['user_password' => myencrypt($password_new, "EduriskPayment2022!")]);
			
			if ($result > 0) {
				$crud_result = 1;
				$crud_message = 'Data has been updated.';
			}  else {$crud_message = 'Failed to update data.';}
		} else {
			$crud_message = 'Failed to reset password.';
		}
		$data['crud_result'] = $crud_result;
		$data['crud_message'] = $crud_message;
		$data['ep_user'] = Users::All();
		return view('management_of_user',$data);
    }
	
	public function updateStatus(Request $request)
    {
		$result = Users::where([
				['user_id', '=', $request->input('id_update_status')]
			])->update(['user_status' => $request->input('status_update')]);
		$crud_result = 0;
		$crud_message = '';
		if ($result > 0) {
			$crud_result = 1;
			$crud_message = 'Data has been updated.';
		}  else {$crud_message = 'Failed to update data.';}
		
		$data['crud_result'] = $crud_result;
		$data['crud_message'] = $crud_message;
		$data['ep_user'] = Users::All();
		return view('management_of_user',$data);
    }
	
	public function activation_account(Request $request)
    {
		$username_activation = $request->input('username_activation');
		$password_activation = mydecrypt($request->input('password_activation'), "EduriskPayment2022!");
		$name_activation = $request->input('name_activation');
		$email_activation = $request->input('email_activation');
		
		// send mail
		$to_name = $name_activation;
		$to_email = $email_activation ;
		$data = array('name'=>"EDURISK", "body" => "Test mail");
		$body_html = "
			Thank you for your registration in Edurisk Payment.
			<br>
			<br>
			<b>Activation your account success!</b>
			<br>
			<br>
			<p>
				username: $username_activation
				<br>
				password: $password_activation
			</p>
			<br>
			You can change the default password after logging in at <a href='https://edurisk-payment.drrc.my.id/' target='_blank'>https://edurisk-payment.drrc.my.id/</a>
			<br>
			<br>
			Thanks Regards,
			<br>
			<br>
			Edurisk DRRC UI
		";
		
		Mail::send([], $data, function($message) use ($to_name, $to_email, $body_html) {
			$message->to($to_email, $to_name)
					->subject('Activation Account EDURISK Payment - DRRC UI')
					->setBody($body_html, 'text/html');
		});
		
		// check for failures
		$check_mail = "";
		if (Mail::failures()) {
			// return response showing failed emails
			$check_mail = "Email messages did not reach the user.";
		}
		
		$result = Users::where([
				['user_id', '=', $request->input('id_update_status_activation')]
			])->update(['user_status' => 1]);
		$crud_result = 0;
		$crud_message = '';
		if ($result > 0) {
			$crud_result = 1;
			$crud_message = 'Account has been active. '.$check_mail;
		}  else {$crud_message = 'Failed to activation account.';}
		
		$data['crud_result'] = $crud_result;
		$data['crud_message'] = $crud_message;
		$data['ep_user'] = Users::All();
		return view('management_of_user',$data);
    }
	
	public function insert_user(Request $request)
	{
		date_default_timezone_set('Asia/Jakarta'); // set time jakarta
		$today = date("Y-m-d");
		
		$cek_data_user = Users::
            where([
				['user_username', '=', $request->input("user_username")]
			])->first();
		
		$crud_result = 0;
		$crud_message = '';
		if ($cek_data_user == null) {
			$role = $request->input("user_role");
			$user_name = $request->input("user_name");
			
			$data = array(
					'user_username' => $request->input("user_username"),
					'user_password' => myencrypt("Edurisk@".date('Y'), "EduriskPayment2022!"),
					'user_name' => $user_name,
					'user_date_of_born' => $request->input("user_date_of_born"),
					'user_place_of_born' => $request->input("user_place_of_born"),
					'user_gender' => $request->input("user_gender"),
					'user_address' => $request->input("user_address"),
					'user_email' => $request->input("user_email"),
					'user_phone' => $request->input("user_phone"),
					'user_status' => 1,
					'user_modiby' => session('user_username'),
					'user_modidate' => $today,
					'user_role' => $role,
					'user_institution' => $request->input("user_company")
				);
				$result = Users::insert($data);
				
				if ($result > 0) {
					$crud_result = 1;
					$crud_message = 'Data has been added.';
				}  else {$crud_message = 'Failed to add data.';}
		} else {
			$crud_message = 'Username already exists.';
		}
		$data['crud_result'] = $crud_result;
		$data['crud_message'] = $crud_message;
		$data['ep_user'] = Users::All();
		return view('management_of_user',$data);
	}
	
	public function update_user(Request $request)
	{
		date_default_timezone_set('Asia/Jakarta'); // set time jakarta
		$today = date("Y-m-d");
		
		$cek_data_user = Users::
            where([
				['user_username', '=', $request->input("user_username")]
			])->first();
		
		if ($cek_data_user == null) {
			$data = array(
					//'user_username' => $request->input("user_username_update"),
					'user_name' => $request->input("user_name_update"),
					'user_date_of_born' => $request->input("user_date_of_born_update"),
					'user_place_of_born' => $request->input("user_place_of_born_update"),
					'user_gender' => $request->input("user_gender_update"),
					'user_address' => $request->input("user_address_update"),
					'user_email' =>$request->input("user_email_update"),
					'user_phone' => $request->input("user_phone_update"),
					'user_modiby' => session('user_username'),
					'user_modidate' => $today,
					'user_role' => $request->input("user_role_update"),
					'user_institution' => $request->input("user_company_update")
				);
				$result = Users::where([
					['user_id', '=', $request->input('id_update')]
				])->update($data);

			$crud_result = 0;
			$crud_message = '';
				if ($result > 0) {
					$crud_result = 1;
					$crud_message = 'Data has been updated.';
				}  else {$crud_message = 'Failed to update data.';}
		} else {
			$crud_message = 'Username already exists.';
		}
			
		$data['crud_result'] = $crud_result;
		$data['crud_message'] = $crud_message;
		$data['ep_user'] = Users::All();
		return view('management_of_user',$data);
	}
}
