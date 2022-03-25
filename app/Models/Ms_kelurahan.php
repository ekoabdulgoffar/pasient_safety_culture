<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ms_kelurahan extends Model
{
	public $timestamps = false;
    protected $table = 'ms_kelurahan';
    protected $fillable = [
        'kelurahan_id','kecamatan_id','kelurahan_nama','kelurahan_created_by','kelurahan_modified_by','kelurahan_created_date','kelurahan_modified_date'
    ];
}
