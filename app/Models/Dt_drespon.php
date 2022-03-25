<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dt_drespon extends Model
{
	public $timestamps = false;
    protected $table = 'dt_drespon';
    protected $fillable = [
        'drespon_id','respon_id','dkuesioner_id','drespon_jawaban','drespon_keterangan'
    ];
}
