<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ms_rw extends Model
{
	public $timestamps = false;
    protected $table = 'ms_rw';
    protected $fillable = [
        'rw_id','kelurahan_id','rw_','rw_created_by','rw_modified_by','rw_created_date','rw_modified_date'
    ];
}
