<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ms_kecamatan extends Model
{
	public $timestamps = false;
    protected $table = 'ms_kecamatan';
    protected $fillable = [
        'kecamatan_id','kecamatan_nama','kecamatan_created_by','kecamatan_modified_by','kecamatan_created_date','kecamatan_modified_date'
    ];
}
