<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ms_kuesioner extends Model
{
	public $timestamps = false;
    protected $table = 'ms_kuesioner';
    protected $fillable = [
        'kuesioner_id','kuesioner_deskripsi','kuesioner_created_by','kuesioner_modified_by','kuesioner_created_date','kuesioner_modified_date'
    ];
}
