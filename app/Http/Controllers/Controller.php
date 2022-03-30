<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Dt_drespon;
use App\Models\Dt_dkuesioner;
use App\Models\Tr_drespon;
use App\Models\Ms_kuesioner;
use App\Models\Ms_skor;
use App\Models\Ms_pertanyaan;
use App\Models\Ms_jenis_pertanyaan;
use App\Models\Ms_kelompok_pertanyaan;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function getMean($skor, $total){
        $skor = $skor / $total;
        return $skor;
    }
    function getKuesionerByResponId($respon_id){
        $data = Dt_drespon::where('respon_id', $respon_id)->first();
        $data = Dt_dkuesioner::where('dkuesioner_id', $data['dkuesioner_id'])->first();
        $data = Ms_kuesioner::where('kuesioner_id', $data['kuesioner_id'])->first();

        return $data;
    }

    function getListPertanyaanByKuesionerId($kuesioner_id){
        $data = Dt_dkuesioner::where('kuesioner_id', $kuesioner_id)->get();
        $pertanyaan = [];
        foreach($data as $d){
            array_push( $pertanyaan, Ms_pertanyaan::where('pertanyaan_id', $d['pertanyaan_id'])->first());
        }
        return $pertanyaan;
    }

    // JENIS PERTANYAAN
    function getJenisPertanyaanById($jenis_pertanyaan_id){
        $data = Ms_jenis_pertanyaan::where('jenis_pertanyaan_id', $jenis_pertanyaan_id)->first();
        return $data;
    }
    function getListJenisPertanyaan(){
        return Ms_jenis_pertanyaan::get();
    }
    // END JENIS PERTANYAAN

    // KELOMPOK PERTANYAAN
    function getListKelompokPertanyaan(){
        return Ms_kelompok_pertanyaan::get();
    }

    function getKelompokPertanyaanById($kelompok_pertanyaan_id){
        return Ms_kelompok_pertanyaan::where('kelompok_pertanyaan_id', $kelompok_pertanyaan_id)->first();
    }
    // END KELOMPOK PERTANYAAN
	
	// PROVINSI
	function getProvinsi() {
		return [
    'ID' => [
				[
					'name' => 'Aceh',
					'iso_code' => 'AC',
				],
				[
					'name' => 'Bali',
					'iso_code' => 'BA',
				],
				[
					'name' => 'Banten',
					'iso_code' => 'BT',
				],
				[
					'name' => 'Bengkulu',
					'iso_code' => 'BE',
				],
				[
					'name' => 'DKI Jakarta',
					'iso_code' => 'JK',
				],
				[
					'name' => 'Gorontalo',
					'iso_code' => 'GO',
				],
				[
					'name' => 'Jambi',
					'iso_code' => 'JA',
				],
				[
					'name' => 'Jawa Barat',
					'iso_code' => 'JB',
				],
				[
					'name' => 'Jawa Tengah',
					'iso_code' => 'JT',
				],
				[
					'name' => 'Jawa Timur',
					'iso_code' => 'JI',
				],
				[
					'name' => 'Kalimantan Barat',
					'iso_code' => 'KB',
				],
				[
					'name' => 'Kalimantan Selatan',
					'iso_code' => 'KS',
				],
				[
					'name' => 'Kalimantan Tengah',
					'iso_code' => 'KT',
				],
				[
					'name' => 'Kalimantan Timur',
					'iso_code' => 'KI',
				],
				[
					'name' => 'Kalimantan Utara',
					'iso_code' => 'KU',
				],
				[
					'name' => 'Kepulauan Bangka Belitung',
					'iso_code' => 'BB',
				],
				[
					'name' => 'Kepulauan Riau',
					'iso_code' => 'KR',
				],
				[
					'name' => 'Lampung',
					'iso_code' => 'LA',
				],
				[
					'name' => 'Maluku',
					'iso_code' => 'MA',
				],
				[
					'name' => 'Maluku Utara',
					'iso_code' => 'MU',
				],
				[
					'name' => 'Nusa Tenggara Barat',
					'iso_code' => 'NB',
				],
				[
					'name' => 'Nusa Tenggara Timur',
					'iso_code' => 'NT',
				],
				[
					'name' => 'Papua',
					'iso_code' => 'PA',
				],
				[
					'name' => 'Papua Barat',
					'iso_code' => 'PB',
				],
				[
					'name' => 'Riau',
					'iso_code' => 'RI',
				],
				[
					'name' => 'Sulawesi Barat',
					'iso_code' => 'SR',
				],
				[
					'name' => 'Sulawesi Selatan',
					'iso_code' => 'SN',
				],
				[
					'name' => 'Sulawesi Tengah',
					'iso_code' => 'ST',
				],
				[
					'name' => 'Sulawesi Tenggara',
					'iso_code' => 'SG',
				],
				[
					'name' => 'Sulawesi Utara',
					'iso_code' => 'SA',
				],
				[
					'name' => 'Sumatera Barat',
					'iso_code' => 'SB',
				],
				[
					'name' => 'Sumatera Selatan',
					'iso_code' => 'SS',
				],
				[
					'name' => 'Sumatera Utara',
					'iso_code' => 'SU',
				],
				[
					'name' => 'Yogyakarta',
					'iso_code' => 'YO',
				],
			]
		];
	}
	// END PROVINSI
}
