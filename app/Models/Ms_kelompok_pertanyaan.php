<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ms_kelompok_pertanyaan extends Model
{
	public $timestamps = false;
    protected $table = 'ms_kelompok_pertanyaan';
    protected $fillable = [
        'kelompok_pertanyaan_id','kelompok_pertanyaan_deskripsi','kelompok_pertanyaan_created_by','kelompok_pertanyaan_modified_by','kelompok_pertanyaan_created_date','kelompok_pertanyaan_modified_date'
    ];
}
