<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tr_respon;
use App\Models\Ms_kuesioner;
use App\Models\Dt_dkuesioner;
use App\Models\Dt_drespon;


class UserKuesionerController extends Controller
{
    //
    function index($id){
        $this->checklogin();

        $id = mydecrypt($id, "Siperikar@drrc-ui20221");

        // variable kirim ke view
        $pass = [];

        // validasi ngisi yang udah ada
        $respon = Tr_respon::where('user_id', session('user_id'))
        ->get();
        foreach($respon as $r){            
            if($this->getKuesionerByResponId($r['respon_id'])['kuesioner_id'] == $id){
                return redirect('user-kuesioner');
            }
            // if(count($this->getListPertanyaanByKuesionerId($r['respon_id'])) > 0){
                
            //     if($this->getListPertanyaanByKuesionerId($r['respon_id'])['kuesioner_id'] == $id){
            //         return redirect('user-kuesioner');
            //     }
            // }
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
        $this->checklogin();
        
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
            'user_id' => session('user_id'),
            'respon_datetime' => date('Y-m-d H:i:s')
        ];        
        $tr_respon = Tr_respon::create($insert);
        
        // insert detail pada dt_drespon
        foreach($pertanyaan as $p){
            $drespon = [
                'respon_id' => $tr_respon['id'],
                // 'respon_id' => 1133,
                'dkuesioner_id' => Dt_dkuesioner::where('pertanyaan_id', $p['pertanyaan_id'])->first()['dkuesioner_id'],
                'drespon_jawaban' => $request['poin:'. $p['pertanyaan_id']],
                'drespon_keterangan' => $request['ket:'.$p['pertanyaan_id']] ? $request['ket:'.$p['pertanyaan_id']] : '-'
            ];
            $in = Dt_drespon::create($drespon);
        }

        // return $request;
        return redirect('user-kuesioner');
    }

    function detailKuesioner($id){
        $this->checklogin();
        
        $pass = [];
        $id = mydecrypt($id, "Siperikar@drrc-ui20221");

        // validasi ngisi yang udah ada
        $respon = Tr_respon::where('user_id', session('user_id'))->get();
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
        $this->checklogin();

        $id = mydecrypt($id, "Siperikar@drrc-ui20221");

        // variable kirim ke view
        $pass = [];

        // validasi ngisi yang udah ada
        $respon = Tr_respon::where('user_id', session('user_id'))->get();
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
