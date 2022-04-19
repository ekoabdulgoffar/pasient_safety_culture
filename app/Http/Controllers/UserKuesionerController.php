<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tr_respon;
use App\Models\Ms_kuesioner;
use App\Models\Dt_dkuesioner;
use App\Models\Dt_drespon;
use App\Models\Ms_kelompok_pertanyaan;
use App\Models\Ms_pertanyaan;
use App\Models\Ms_file_edukasi;
use App\Models\Tr_edukasi;
use App\Models\Tr_respon_post;
use App\Models\Ms_skor;


class UserKuesionerController extends Controller
{
    //
    function index(){
        
        if (!session()->has('user_id')) {
			return redirect('login');
		}

        // get data response        
        $data_responses = Tr_respon::where('user_id',mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))
        ->get() ;
        
        // jika data response nya kosong, langsung masuk ke halaman kuesioner
        $id_kuesioner = myencrypt(Ms_kuesioner::first()['kuesioner_id'],"Pasientsafetyculture@2022");

        if(count($data_responses) == 0){
            return redirect('user-kuesioner/isi/'.$id_kuesioner);
        }

        $pass = [];

        $data = [];
        // get kelompok
        $kelompok = Ms_kelompok_pertanyaan::get();
        // get data response        
        $data_responses = Tr_respon::where('user_id',mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))
        ->get() ;        

        foreach($data_responses as $data_response){
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
            
            $format = [
                'kuesioner' => $this->getKuesionerByResponId($data_response['respon_id']),
                'respon' => $data_response,
                'total_skor' => $total_skor,
                'skor_mean' => $skor_mean,
                'mean_total_skor' => $this->getMean($total_skor,$jumlah_pertanyaan)
            ];
            
            array_push($data, $format);
        }
        $pass['data'] = $data;

        // get tr_edukasi terakhir
        $tr_edukasi = Tr_edukasi::where('user_id', mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))
        ->orderBy('datetime_update', 'desc')
        ->first();

        $available = false;
        if($tr_edukasi['tr_edu_isPdf'] == 1 && $tr_edukasi['tr_edu_isVideo'] == 1){
            $available = true;
        }

        // Tab ke 2
        
        // get data kuesioner
        $data_kuesioners = Ms_kuesioner::get();

        $kuesioners = [];
        foreach($data_kuesioners as $data_kuesioner){
            $lastRespon = Tr_respon::where('user_id', mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))
            ->orderBy('respon_datetime', 'desc')
            ->join('dt_drespon', 'dt_drespon.respon_id', '=', 'tr_respon.respon_id')
            ->join('dt_dkuesioner', 'dt_dkuesioner.dkuesioner_id', '=', 'dt_drespon.dkuesioner_id')
            ->join('ms_kuesioner', 'ms_kuesioner.kuesioner_id','=','dt_dkuesioner.kuesioner_id')
            ->where('ms_kuesioner.kuesioner_id', $data_kuesioner['kuesioner_id'])
            ->first();
            
            $format = [
                'kuesioner_id' => $data_kuesioner['kuesioner_id'],
                'kuesioner_deskripsi' => $data_kuesioner['kuesioner_deskripsi'],
                'kuesioner_created_by' => $data_kuesioner['kuesioner_created_by'],
                'kuesioner_modified_by' => $data_kuesioner['kuesioner_modified_by'],
                'kuesioner_created_date' => $data_kuesioner['kuesioner_created_date'],
                'kuesioner_modified_date' => $data_kuesioner['kuesioner_modified_date'],                
                'kuesioner_available' => $available,
            ];
            array_push($kuesioners, $format);
        }
        $pass['data2'] = $kuesioners;

        $pass['skor'] = Ms_skor::get();
        $pass['kelompok'] = $kelompok;
        return view('user_kuesioner_history', $pass);
    }

    function goto_isi_kuesioner_page($id){
        if (!session()->has('user_id')) {
			return redirect('login');
		};
        
        $id = mydecrypt($id, "Pasientsafetyculture@2022");

        // variable kirim ke view
        $pass = [];

        // validasi id kuesioner        
        $kues = Ms_kuesioner::where('kuesioner_id', $id)->first();
        if($kues == null){
            return redirect('user-kuesioner');
        }
        
        $pertanyaan = $this->getListPertanyaanByKuesionerId($id);
        $jenis_pertanyaan = $this->getListJenisPertanyaan();
        $kelompok_pertanyaan = $this->getListKelompokPertanyaan();
        $kuesioner = Ms_kuesioner::where('kuesioner_id', $id)->first();
        
        $pertanyaan_urut_by_kelompok_jenis = [];
        // pengurutan pertanyaan berdasarkan kelompok
        foreach($kelompok_pertanyaan as $k){
            $pertanyaan_berkelompok = [];
            foreach($pertanyaan as $p){
                if($k['kelompok_pertanyaan_id'] == $p['kelompok_pertanyaan_id']){
                    array_push($pertanyaan_berkelompok, $p);
                }
            }
            if(count($pertanyaan_berkelompok) > 0){
                array_push($pertanyaan_urut_by_kelompok_jenis, $pertanyaan_berkelompok);
            }            
        }                

        $pass['pertanyaan'] = $pertanyaan_urut_by_kelompok_jenis;
        $pass['jenis_pertanyaan'] = $jenis_pertanyaan;
        $pass['kuesioner'] = $kuesioner;
        $pass['kelompok_pertanyaan'] = $kelompok_pertanyaan;
        return view('user_kuesioner_isi', $pass);
    }

    function submitKuesioner(Request $request){
        if (!session()->has('user_id')) {
			return redirect('login');
		};
        date_default_timezone_set('Asia/Jakarta'); // set time jakarta
        
        // get data pertanyaan
        $pertanyaan = $this->getListPertanyaanByKuesionerId($request['kuesioner_id']);
        $pertanyaan_urut_by_kelompok_jenis = [];
        $kelompok_pertanyaan = $this->getListKelompokPertanyaan();

        // pengurutan pertanyaan berdasarkan kelompok
        foreach($kelompok_pertanyaan as $k){
            foreach($pertanyaan as $p){
                if($k['kelompok_pertanyaan_id'] == $p['kelompok_pertanyaan_id']){
                    array_push($pertanyaan_urut_by_kelompok_jenis, $p);
                }
            }
        }
        $pertanyaan = $pertanyaan_urut_by_kelompok_jenis;

        // insert row pada tr_respon
        $insert = [
            'user_id' => (int) mydecrypt(session('user_id'), "Pasientsafetyculture@2022"),
            'respon_datetime' => date('Y-m-d H:i:s')
        ];        
        $tr_respon = Tr_respon::create($insert);
        
        // insert detail pada dt_drespon
        foreach($pertanyaan as $p){
            $drespon = [
                'respon_id' => $tr_respon['id'],
                // 'respon_id' => 1133,
                'dkuesioner_id' => Dt_dkuesioner::where('pertanyaan_id', $p['pertanyaan_id'])->first()['dkuesioner_id'],
                'drespon_jawaban' => $request['p'. $p['pertanyaan_id']],
                'drespon_keterangan' => $request['ket:'.$p['pertanyaan_id']] ? $request['ket:'.$p['pertanyaan_id']] : '-'
            ];
            $in = Dt_drespon::create($drespon);
        }

        // return $request;
        // Check apakah respon lebih dari 60

        $kelompok = Ms_kelompok_pertanyaan::get();
        
        $total_skor = 0;
        $jumlah_pertanyaan = 0;

        $kuesioner = $this->getKuesionerByResponId($tr_respon['id']);
        $jawaban = Dt_drespon::where('respon_id', $tr_respon['id'])->get();
        
        foreach ($jawaban as $key => $j) {
            $dt_dkuesioner = Dt_dkuesioner::where('dkuesioner_id',$j['dkuesioner_id'])->first();
            $pertanyaan = Ms_pertanyaan::where('pertanyaan_id', $dt_dkuesioner['pertanyaan_id'])->first();
            foreach ($kelompok as $k) {
                if($k['kelompok_pertanyaan_deskripsi'] != 'Pribadi'){
                    if($pertanyaan['kelompok_pertanyaan_id'] == $k['kelompok_pertanyaan_id']){
                        $total_skor+=$j['drespon_jawaban'];
                        $jumlah_pertanyaan++;
                        break;
                    }
                }
            }                
        }
        
        $total_skor = $this->getMean($total_skor,$jumlah_pertanyaan);
        if($total_skor < 60){
            $tr_edukasi = [
                'edu_id' => Ms_file_edukasi::orderBy('edu_id', 'desc')->first()['edu_id'],
                'user_id' => (int) mydecrypt(session('user_id'), "Pasientsafetyculture@2022"),
                'tr_edu_isPdf' => 0,
                'tr_edu_isVideo' => 0,
                'datetime_update' => date('Y-m-d H:i:s')
            ];
            Tr_edukasi::create($tr_edukasi);
        }
        return redirect('user-dashboard');
    }

    function detailKuesioner($id){
        if (!session()->has('user_id')) {
			return redirect('login');
		};
        
        $pass = [];
        $id = mydecrypt($id, "Pasientsafetyculture@2022");

        // validasi ngisi yang udah ada
        $respon = Tr_respon::where('user_id', mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))->get();
        $resp;
        foreach($respon as $r){
            if($this->getKuesionerByResponId($r['respon_id'])['kuesioner_id'] == $id){                
                $resp = $r;                
                break;
            }
        }
        
        if($resp == null){
            return redirect('user-kuesioner');
        }
        
        $pertanyaan = $this->getListPertanyaanByKuesionerId($id);
        $jenis_pertanyaan = $this->getListJenisPertanyaan();
        $kelompok_pertanyaan = $this->getListKelompokPertanyaan();
        $kuesioner = $this->getKuesionerByResponId($id);
        $drespon = Dt_drespon::where('respon_id', $resp['respon_id'])->get();
        
        $pertanyaan_urut_by_kelompok_jenis = [];
        // pengurutan pertanyaan berdasarkan kelompok
        foreach($kelompok_pertanyaan as $k){
            $pertanyaan_berkelompok = [];
            foreach($pertanyaan as $p){
                if($k['kelompok_pertanyaan_id'] == $p['kelompok_pertanyaan_id']){
                    array_push($pertanyaan_berkelompok, $p);
                }
            }
            if(count($pertanyaan_berkelompok) > 0){
                array_push($pertanyaan_urut_by_kelompok_jenis, $pertanyaan_berkelompok);
            }            
        }

        // Detail pengisian
        $hasil = $this->getHasilResponse($id);
        $skor =  $this->getSkorByHasil($hasil);                

        $pass['pertanyaan'] = $pertanyaan_urut_by_kelompok_jenis;
        $pass['jenis_pertanyaan'] = $jenis_pertanyaan;
        $pass['kuesioner'] = $kuesioner;
        $pass['kelompok_pertanyaan'] = $kelompok_pertanyaan;
        $pass['drespon'] = $drespon;
        $pass['hasil'] = $hasil;
        $pass['skor'] = $skor;
        $pass['respon'] = $resp;
        // return $drespon;
        // return $request;
        return view('user_kuesioner_detail', $pass);
    }

    function editKuesioner($id){
        if (!session()->has('user_id')) {
			return redirect('login');
		};

        $id = mydecrypt($id, "Pasientsafetyculture@2022");

        // variable kirim ke view
        $pass = [];

        // validasi ngisi yang udah ada
        $respon = Tr_respon::where('user_id', mydecrypt(session('user_id'), "Pasientsafetyculture@2022"))->get();
        $resp;
        foreach($respon as $r){
            if($this->getKuesionerByResponId($r['respon_id'])['kuesioner_id'] == $id){                
                $resp = $r;                
                break;
            }
        }
        
        if($resp == null){
            return redirect('user-kuesioner');
        }
        
        $pertanyaan = $this->getListPertanyaanByKuesionerId($id);
        $jenis_pertanyaan = $this->getListJenisPertanyaan();
        $kelompok_pertanyaan = $this->getListKelompokPertanyaan();
        $kuesioner = Ms_kuesioner::where('kuesioner_id', $id)->first();
        
        $pertanyaan_urut_by_kelompok_jenis = [];
        // pengurutan pertanyaan berdasarkan kelompok
        foreach($kelompok_pertanyaan as $k){
            $pertanyaan_berkelompok = [];
            foreach($pertanyaan as $p){
                if($k['kelompok_pertanyaan_id'] == $p['kelompok_pertanyaan_id']){
                    array_push($pertanyaan_berkelompok, $p);
                }
            }
            if(count($pertanyaan_berkelompok) > 0){
                array_push($pertanyaan_urut_by_kelompok_jenis, $pertanyaan_berkelompok);
            }            
        }                

        $pass['pertanyaan'] = $pertanyaan_urut_by_kelompok_jenis;
        $pass['jenis_pertanyaan'] = $jenis_pertanyaan;
        $pass['kuesioner'] = $kuesioner;
        $pass['kelompok_pertanyaan'] = $kelompok_pertanyaan;
        
        return view('user_kuesioner_edit', $pass);
    }
}
