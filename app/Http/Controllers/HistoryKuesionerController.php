<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ms_kuesioner;
use App\Models\Dt_drespon;
use App\Models\Ms_jenis_pertanyaan;
use App\Models\Ms_kecamatan;
use App\Models\Ms_kelompok_pertanyaan;
use App\Models\Ms_kelurahan;
use App\Models\Ms_pertanyaan;
use App\Models\Ms_rw;
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
		
		$table_history_header=array("No","Kecamatan","Kelurahan","RW","Ketua RW","Telepon");
		
		for ($i = 1; $i <= 22; $i++) {
			$table_history_header_temp = "p-".$i;
			array_push($table_history_header, $table_history_header_temp);
		}
		array_push($table_history_header, "Nilai", "Tingkat");
		
		// data untuk responden
		$data_responden = Dt_drespon
            ::join('tr_respon', 'tr_respon.respon_id', '=', 'dt_drespon.respon_id')
			->join('dt_dkuesioner', 'dt_dkuesioner.dkuesioner_id', '=', 'dt_drespon.dkuesioner_id')
			->join('ms_user', 'ms_user.user_id', '=', 'tr_respon.user_id')
			->join('ms_rw', 'ms_rw.rw_id', '=', 'ms_user.rw_id')
			->join('ms_kelurahan', 'ms_kelurahan.kelurahan_id', '=', 'ms_rw.kelurahan_id')
			->join('ms_kecamatan', 'ms_kecamatan.kecamatan_id', '=', 'ms_kelurahan.kecamatan_id')
            ->select('dt_drespon.respon_id','ms_kecamatan.kecamatan_nama','ms_kelurahan.kelurahan_nama','ms_rw.rw_',
			'ms_user.user_name','ms_user.user_phone','ms_user.user_id')
            ->where([
				['dt_dkuesioner.kuesioner_id', '=', 1]
			])->groupBy('dt_drespon.respon_id','ms_kecamatan.kecamatan_nama','ms_kelurahan.kelurahan_nama','ms_rw.rw_',
			'ms_user.user_name','ms_user.user_phone','ms_user.user_id')->get();	
			
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
				->join('ms_rw', 'ms_rw.rw_id', '=', 'ms_user.rw_id')
				->join('ms_kelurahan', 'ms_kelurahan.kelurahan_id', '=', 'ms_rw.kelurahan_id')
				->join('ms_kecamatan', 'ms_kecamatan.kecamatan_id', '=', 'ms_kelurahan.kecamatan_id')
				->select('dt_drespon.drespon_jawaban')
				->where([
					['dt_dkuesioner.kuesioner_id', '=', 1],
					['tr_respon.user_id', '=', $ou->user_id],
					['tr_respon.respon_id', '=', $ou->respon_id]
				])->get();
			
			$table_history_isi_jawaban_temp = "<tr>
					<td>".$no."</td>
					<td>".$ou['kecamatan_nama']."</td>
					<td>".$ou['kelurahan_nama']."</td>
					<td>".$ou['rw_']."</td>
					<td>".$ou['user_name']."</td>
					<td>".$ou['user_phone']."</td>
			";
			
			$jumlah_pertanyaan = count ($data_responden_jawaban);
			$nilai = 0;
			$tingkat = "";
			
			$cek_jumlah_jawaban = 0;
			
			
			foreach ($data_responden_jawaban as $ou2) { // Ya = 1, Tidak Tahu = 0, Tidak = -1
				$nilai_temp = $ou2['drespon_jawaban'];
				if ($nilai_temp == "-1") $nilai_temp = 0;
				else if ($nilai_temp == "0") $nilai_temp = 1;
				else $nilai_temp = $ou2['drespon_jawaban'];
				$table_history_isi_jawaban_temp2 .= "
					<td>".$nilai_temp."</td>
				";
				$nilai += ($nilai_temp / $jumlah_pertanyaan) * 100;
				$cek_jumlah_jawaban++;
				
				if ($cek_jumlah_jawaban == 22) {
					if ($nilai < 20) $tingkat = "SANGAT RINGAN";
					else if ($nilai < 40) $tingkat = "RINGAN";
					else if ($nilai < 60) $tingkat = "SEDANG";
					else if ($nilai < 80) $tingkat = "BERAT";
					else if ($nilai < 100) $tingkat = "SANGAT BERAT";
					
					$table_history_isi_jawaban .= "
					$table_history_isi_jawaban_temp
					$table_history_isi_jawaban_temp2
							<td>".number_format($nilai,2,",","")."%</td>
							<td>".$tingkat."</td>
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
