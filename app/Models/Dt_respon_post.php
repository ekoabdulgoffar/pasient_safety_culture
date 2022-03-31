<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dt_respon_post extends Model
{
	public $timestamps = false;
    protected $table = 'dt_respon_post';
    protected $fillable = [
        'respon_post_id','dtpost_test_id','drespon_jawaban'
    ];
}
