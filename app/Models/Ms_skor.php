<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ms_skor extends Model
{
	public $timestamps = false;
    protected $table = 'ms_skor';
    protected $fillable = [
        'skor_id','skor_max','skor_deskripsi','skor_warna','skor_icon','skor_created_by','skor_modified_by','skor_created_date','skor_modified_date'
    ];
}
