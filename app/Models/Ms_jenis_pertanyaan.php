<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ms_jenis_pertanyaan extends Model
{
	public $timestamps = false;
    protected $table = 'ms_jenis_pertanyaan';
    protected $fillable = [
        'jenis_pertanyaan_id','jenis_pertanyaan_deskripsi','jenis_pertanyaan_skala','jenis_pertanyaan_parameter','jenis_pertanyaan_created_by','jenis_pertanyaan_modified_by','jenis_pertanyaan_created_date','jenis_pertanyaan_modified_date'
    ];
}
