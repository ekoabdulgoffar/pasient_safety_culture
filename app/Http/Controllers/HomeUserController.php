<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tr_edukasi;
use App\Models\Ms_kuesioner;
use App\Models\Tr_respon;
use App\Models\Ms_kelompok_pertanyaan;
use App\Models\Dt_drespon;
use App\Models\Dt_dkuesioner;
use App\Models\Ms_pertanyaan;
use App\Models\Ms_skor;
use App\Models\Tr_respon_post;
use App\Models\Ms_post_test;
use App\Models\Dt_post_test;
use App\Models\Ms_pertanyaan_post;
use App\Models\Dt_respon_post;
use App\Models\Ms_file_edukasi;

class HomeUserController extends Controller
{
    //
    function index(){
        if (!session()->has('user_id')) {
			return redirect('login');
		};

        $pass = [];

        // get data response        
        $data_responses = Tr_respon::where('user_id',mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))
        ->get() ;
        
        // jika data response nya kosong, langsung masuk ke halaman kuesioner
        $id_kuesioner = myencrypt(Ms_kuesioner::first()['kuesioner_id'],"Pasientsafetyculture@2022");

        if(count($data_responses) == 0){
            return redirect('user-kuesioner/isi/'.$id_kuesioner);
        }

        // get kelompok
        $data = [];
        $kelompok = Ms_kelompok_pertanyaan::get();
        $data_response = $data_responses[count($data_responses) -1];
        
        $hasil = 0;
        $skor = [];
        $total_skor = 0;
        $jumlah_pertanyaan = 0;
            
        foreach ($kelompok as $k) {
            array_push($skor,0);
        }
        array_push($skor,0);

        $kuesioner = $this->getKuesionerByResponId($data_response['respon_id']);
        $jawaban = Dt_drespon::where('respon_id', $data_response['respon_id'])->get();
        
        foreach ($jawaban as $key => $j) {
            
            $dt_dkuesioner = Dt_dkuesioner::where('dkuesioner_id',$j['dkuesioner_id'])->first();
            $pertanyaan = Ms_pertanyaan::where('pertanyaan_id', $dt_dkuesioner['pertanyaan_id'])->first();
            foreach ($kelompok as $k) {
                if($pertanyaan['kelompok_pertanyaan_id'] == $k['kelompok_pertanyaan_id']){
                    $skor[$pertanyaan['kelompok_pertanyaan_id']]+=$j['drespon_jawaban'];
                    $total_skor+=$j['drespon_jawaban'];
                    $jumlah_pertanyaan++;
                    break;
                }                
            }                
        }
        $skor_mean = [];

        foreach ($skor as $key=>$s) {
            $jumlah = count(Ms_pertanyaan::where('kelompok_pertanyaan_id', $key)->get());
            if($jumlah != 0){
                array_push($skor_mean, $this->getMean($s, $jumlah));
            }else{
                array_push($skor_mean, -1);
            }            
        }
        // get last tr_edukasi
        $tr_edukasi = Tr_edukasi::where('user_id', mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))
        ->orderBy('datetime_update', 'desc')
        ->first();
        
        $format = [
            'kuesioner' => $this->getKuesionerByResponId($data_response['respon_id']),
            'edukasi' => $tr_edukasi,
            'respon' => $data_response,
            'total_skor' => $total_skor,
            'skor_mean' => $skor_mean,
            'mean_total_skor' => $this->getMean($total_skor,$jumlah_pertanyaan)
        ];

		$data_file1 = Ms_file_edukasi::where([
					['edu_desk_video', '=', 'Edukasi 1']
				])->orderBy('edu_id', 'DESC')->first(); // video edukasi 1 - Introduction
		$data_file2 = Ms_file_edukasi::where([
					['edu_category', '=', 'Evaluation']
				])->orderBy('edu_id', 'DESC')->first(); // video edukasi 2 - Evaluation
		
		$link_video_edukasi1 = "<a href='".url('/user-dashboard-video')."/?link=".$data_file1['edu_file_video']."' target='_blank'>Video 1 - Edukasi</a>";
		$link_video_edukasi2 = "<a href='".url('/user-dashboard-video')."/?link=".$data_file2['edu_file_video']."' target='_blank'>Video 2</a>";
		
		$result_skor = "";
		$notes_skor = "";
		if ($format['total_skor'] >= 2325) {
		  $result_skor ='<td>: <span class="badge px-2 py-2 bg-primary rounded text-light">Baik Sekali (Excellent)</span></td>';
		  $notes_skor = '
					<b>Selamat !!</b></b>
					<br>
					Pada survei kali ini Nilai Budaya Keselamatan Pasien Sejawat adalah <b>Baik Sekali</b>. Sejawat telah  memiliki Budaya Keselamatan yang Positif serta sudah memperhatikan faktor budaya keselamatan (<b><i>Safety Culture</i></b>)  di tempat praktik, Pertahankan kondisi yang sudah baik ini dan perlu dilakukan evaluasi berkala untuk mempertahankan kondisi ini dengan nilai yang sudah dalam kategori  tinggi , antara lain terhadap  Faktor Iklim tim kerja, Iklim Keselamatan Pasien, Kepuasan Kerja, Stres, Persepsi Manajemen dan Kondisi kerja.
					<br><br>
					Silahkan ulang menonton '.$link_video_edukasi1.'  dan lanjut  klik '.$link_video_edukasi2.'  perihal <b>Penerapan Budaya Keselamatan Pasien pada praktik Dokter Gigi</b> untuk mendapatkan  gambaran Budaya Keselamatan (<b><i>Safety Culture</b></i>). Setelah itu anda dapat mengisi ulang survei Budaya Keselamatan Pasien dari awal. <b>
					<br>
					Selamat Mencoba,  Semoga Sukses selalu . Terima Kasih.</b>
				';
		}
		elseif ($format['total_skor'] >= 2150 && $format['total_skor'] <= 2324) {
		  $result_skor = '<td>: <span class="badge px-2 py-2 bg-success rounded text-light">Baik (Good)</span></td>';
		  $notes_skor = '
					<b>Selamat !!</b>
					<br>
					Pada survei kali ini Nilai Budaya Keselamatan Pasien Sejawat adalah <b>Baik</b>. Sejawat memiliki Budaya Keselamatan yang <b>Positif</b> serta sudah memperhatikan faktor budaya keselamatan (Safety Culture )  di tempat praktik, Pertahankan kondisi ini dan masih dapat lebih ditingkatkan lagi menjadi nilai lebih tinggi , antara lain terhadap  Faktor Iklim tim kerja, Iklim Keselamatan Pasien, Kepuasan Kerja, Stres, Persepsi Manajemen dan Kondisi kerja. 
					<br><br>
					Silahkan ulang menonton '.$link_video_edukasi1.'  dan lanjut  klik '.$link_video_edukasi2.'  perihal <b>Penerapan Budaya Keselamatan Pasien pada praktik Dokter Gigi</b> untuk mendapatkan  gambaran Budaya Keselamatan (<b><i>Safety Culture</i></b>). Setelah itu anda dapat mengisi ulang survei Budaya Keselamatan Pasien dari awal. 
					<br>
					<b>Selamat Mencoba,  Semoga pada isian berikutnya nilai anda akan lebih meningkat. Semoga Sukses selalu, Terima Kasih.</b>
				';
		}
		elseif ($format['total_skor'] >= 2025 && $format['total_skor'] <= 2149) {
		  $result_skor = '<td>: <span class="badge px-2 py-2 bg-warning rounded text-light">Sedang (Fair)</span></td>';
		  $notes_skor = '
					Pada survei kali ini Nilai Budaya Keselamatan Pasien Sejawat adalah <b>Sedang</b>. 
					Sejawat sudah memperhatikan faktor budaya keselamatan (Safety Culture )  di tempat praktik, tetapi perlu lebih meningkatkan lagi, antara lain Faktor Iklim tim kerja, Iklim Keselamatan Pasien, Kepuasan Kerja, Stres, Persepsi Manajemen dan Kondisi kerja. 
					<br><br>
					Silahkan ulang menonton '.$link_video_edukasi1.'  dan lanjut  klik '.$link_video_edukasi2.'  perihal <b>Penerapan Budaya Keselamatan Pasien pada praktik Dokter Gigi</b> untuk mendapatkan  gambaran Budaya Keselamatan (<b><i>Safety Culture</i></b>). Setelah itu anda dapat mengisi ulang survei Budaya Keselamatan Pasien dari awal. 
					<br>
					<b>Selamat Mencoba,  Semoga pada isian berikutnya nilai anda akan lebih meningkat. Terima Kasih.</b>
				';
		}
		elseif ($format['total_skor'] < 2025) {
		  $result_skor = '<td>: <span class="badge px-2 py-2 bg-danger rounded text-light">Kurang (Poor)</span></td>';
		  $notes_skor = '
					Pada survei kali ini Nilai Budaya Keselamatan Pasien Sejawat adalah <b>Kurang</b>.
					Sejawat perlu lebih memperhatikan tentang faktor budaya keselamatan (Safety Culture )  di tempat praktik, antara lain  Faktor Iklim tim kerja, Iklim Keselamatan Pasien, Kepuasan Kerja, Stres, Persepsi Manajemen dan Kondisi kerja. 
					<br><br>
					Silahkan mengulang menonton '.$link_video_edukasi1.'  dan lanjut  klik '.$link_video_edukasi2.'  perihal Penerapan Budaya Keselamatan Pasien pada praktik Dokter Gigi untuk mendapatkan  gambaran Budaya Keselamatan (<b><i>Safety Culture</i></b>). Setelah itu anda dapat mengisi ulang survei Budaya Keselamatan Pasien dari awal.  
					<br>
					<b>Selamat Mencoba,  Semoga pada isian berikutnya nilai anda akan meningkat. Terima Kasih.</b>
				';
		}
		
        $pass['data'] = $format;
        $pass['skor'] = Ms_skor::get();
        $pass['kelompok'] = $kelompok;
		$pass['result_skor'] = $result_skor;
		$pass['notes_skor'] = $notes_skor;
        return view('user_dashboard', $pass);
    }
	
	function home_video() {
		
		$data['link'] = "";
        return view('user_dashboard_video', $data);
	}
}
