<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ms_pertanyaan extends Model
{
	public $timestamps = false;
    protected $table = 'ms_pertanyaan';
    protected $fillable = [
        'pertanyaan_id','jenis_pertanyaan_id','kelompok_pertanyaan_id','pertanyaan_','pertanyaan_keterangan','pertanyaan_created_by','pertanyaan_modified_by','pertanyaan_created_date','pertanyaan_modified_date'
    ];
}
