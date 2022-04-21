<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ms_kuesioner;
use App\Models\Dt_drespon;
use App\Models\Ms_jenis_pertanyaan;
use App\Models\Ms_kelompok_pertanyaan;
use App\Models\Ms_pertanyaan;
use App\Models\Ms_skor;
use App\Models\Tr_respon;
use App\Models\Users;

class HistoryKuesionerController extends Controller
{
    public function index()
    {
		if (!session()->has('user_id')) {
			return redirect('login');
		} else if (session()->has('user_role') == true && session('user_role') != "Admin" ) {
			return abort(404);
		}
		
		$table_history_header=array("No","Nama","Jenis Kelamin","Tanggal Lahir","Alamat","Provinsi","No Whatsapp","Email","Pendidikan","PDGI Cabang", "PDGI Wilayah","Tempat bekerja atau praktik","Saya berpraktik di (Puskesmas/Klinik/Rumah Sakit Umum/Rumah Sakit Swasta/Dsb.)","Area tempat praktik"
		,"Jumlah pasien yang saya kerjakan per hari","Hingga saat ini telah berpraktik selama","Dalam 5 (lima) tahun terakhir pernahkah anda mengikuti pelatihan/seminar tentang keselamatan pasien ?","Anda memiliki STR yang masih berlaku","Anda memiliki SIP yang masih berlaku");
		
		for ($i = 1; $i <= 30; $i++) {
			$table_history_header_temp = "k".$i;
			array_push($table_history_header, $table_history_header_temp);
		}
		array_push($table_history_header, "Total Score","Teamwork Climate","Safety Climate","Job Satisfaction","Stress Recognition", "Management Perception", "Working Condition","Mean Total skor");
		
		// data untuk responden
		$data_responden = Dt_drespon
            ::join('tr_respon', 'tr_respon.respon_id', '=', 'dt_drespon.respon_id')
			->join('dt_dkuesioner', 'dt_dkuesioner.dkuesioner_id', '=', 'dt_drespon.dkuesioner_id')
			->join('ms_user', 'ms_user.user_id', '=', 'tr_respon.user_id')
            ->select('dt_drespon.respon_id','ms_user.user_id','ms_user.user_name','ms_user.user_jenis_kelamin','ms_user.user_tanggal_lahir','ms_user.user_alamat','ms_user.user_provinsi'
			,'ms_user.user_phone','ms_user.user_email','ms_user.user_pendidikan_terakhir','ms_user.user_cabang_keanggotaan','ms_user.user_wilayah_keanggotaan','ms_user.user_p1','ms_user.user_p2','ms_user.user_p3','ms_user.user_p4','ms_user.user_p5','ms_user.user_p6','ms_user.user_p7','ms_user.user_p8')
            ->where([
				['dt_dkuesioner.kuesioner_id', '=', 1]
			])->groupBy('dt_drespon.respon_id','ms_user.user_id','ms_user.user_name','ms_user.user_jenis_kelamin','ms_user.user_tanggal_lahir','ms_user.user_alamat','ms_user.user_provinsi'
			,'ms_user.user_phone','ms_user.user_email','ms_user.user_pendidikan_terakhir','ms_user.user_cabang_keanggotaan','ms_user.user_wilayah_keanggotaan','ms_user.user_p1','ms_user.user_p2','ms_user.user_p3','ms_user.user_p4','ms_user.user_p5','ms_user.user_p6','ms_user.user_p7','ms_user.user_p8')->get();	
		
		// data untuk jawaban respondent
		$table_history_isi_jawaban = "";
		$table_history_isi_jawaban_temp = "";
		$table_history_isi_jawaban_temp2 = "";
		
		$no = 1;
		$cek_tr_respon = 0;
		foreach ($data_responden as $ou) {
			
			$data_responden_jawaban = Dt_drespon
				::join('tr_respon', 'tr_respon.respon_id', '=', 'dt_drespon.respon_id')
				->join('dt_dkuesioner', 'dt_dkuesioner.dkuesioner_id', '=', 'dt_drespon.dkuesioner_id')
				->join('ms_user', 'ms_user.user_id', '=', 'tr_respon.user_id')
				->select('dt_drespon.drespon_jawaban')
				->where([
					['dt_dkuesioner.kuesioner_id', '=', 1],
					['tr_respon.user_id', '=', $ou->user_id],
					['tr_respon.respon_id', '=', $ou->respon_id]
				])->get();
			
			$table_history_isi_jawaban_temp = "<tr>
					<td>".$no."</td>
					<td>".$ou['user_name']."</td>
					<td>".($ou['user_jenis_kelamin'] == '0' ? 'Perempuan' : 'Laki-laki')."</td>
					<td>".$ou['user_tanggal_lahir']."</td>
					<td>".$ou['user_alamat']."</td>
					<td>".$ou['user_provinsi']."</td>
					<td>".$ou['user_wa']."</td>
					<td>".$ou['user_email']."</td>
					<td>".$ou['user_pendidikan_terakhir']."</td>
					<td>".$ou['user_cabang_keanggotaan']."</td>
					<td>".$ou['user_wilayah_keanggotaan']."</td>
					<td>".$ou['user_p1']."</td>
					<td>".$ou['user_p2']."</td>
					<td>".$ou['user_p3']."</td>
					<td>".$ou['user_p4']."</td>
					<td>".$ou['user_p5']."</td>
					<td>".$ou['user_p6']."</td>
					<td>".$ou['user_p7']."</td>
					<td>".$ou['user_p8']."</td>
			";
			
			$jumlah_pertanyaan = count ($data_responden_jawaban);
			$total_skor = 0;
			$mean_iklim = 0;
			$mean_safety = 0;
			$mean_puas = 0;	
			$mean_stress = 0;
			$mean_persepsi = 0;	
			$mean_kondisi = 0;
			$meantotalskor = 0;

			
			$cek_jumlah_jawaban = 0;
			
			
			foreach ($data_responden_jawaban as $ou2) { 
				$nilai_temp = $ou2['drespon_jawaban'];
				
				$table_history_isi_jawaban_temp2 .= "
					<td>".$nilai_temp."</td>
				";
				$cek_jumlah_jawaban++;
				
				if ($cek_jumlah_jawaban >= 1) $total_skor += $nilai_temp;
				
				if ($cek_jumlah_jawaban >= 1 && $cek_jumlah_jawaban <= 6) $mean_iklim += $nilai_temp; // dibagi 6
				if ($cek_jumlah_jawaban >= 7 && $cek_jumlah_jawaban <= 13) $mean_safety += $nilai_temp; // dibagi 7
				if ($cek_jumlah_jawaban >= 14 && $cek_jumlah_jawaban <= 18) $mean_puas += $nilai_temp; // dibagi 5
				if ($cek_jumlah_jawaban >= 19 && $cek_jumlah_jawaban <= 22) $mean_stress += $nilai_temp; // dibagi 4
				if ($cek_jumlah_jawaban >= 23 && $cek_jumlah_jawaban <= 26) $mean_persepsi += $nilai_temp; // dibagi 4
				if ($cek_jumlah_jawaban >= 27 && $cek_jumlah_jawaban <= 30) $mean_kondisi += $nilai_temp; // dibagi 4
				
				
				if ($cek_jumlah_jawaban == 30) {
					
					$meantotalskor = $total_skor / 30;
					
					$table_history_isi_jawaban .= "
					$table_history_isi_jawaban_temp
					$table_history_isi_jawaban_temp2
							<td style='text-align: center;'>".number_format($total_skor,2,",","")."</td>
							<td style='text-align: center;'>".number_format($mean_iklim/6,2,",","")."</td>
							<td style='text-align: center;'>".number_format($mean_safety/7,2,",","")."</td>
							<td style='text-align: center;'>".number_format($mean_puas/5,2,",","")."</td>
							<td style='text-align: center;'>".number_format($mean_stress/4,2,",","")."</td>
							<td style='text-align: center;'>".number_format($mean_persepsi/4,2,",","")."</td>
							<td style='text-align: center;'>".number_format($mean_kondisi/4,2,",","")."</td>
							<td style='text-align: center;'>".number_format($meantotalskor,2,",","")."</td>
					</tr>";
					$no++;
					$cek_jumlah_jawaban = 0;
					$table_history_isi_jawaban_temp2 = "";
					
					$cek_tr_respon = $ou->user_id;
				}
			}
		}
		
		$data['table_history_header'] = $table_history_header;
		$data['table_history_isi_jawaban'] = $table_history_isi_jawaban;
        return view('history_kuesioner', $data);
    }
}
