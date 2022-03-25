<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dt_dkuesioner extends Model
{
	public $timestamps = false;
    protected $table = 'dt_dkuesioner';
    protected $fillable = [
        'dkuesioner_id','pertanyaan_id','kuesioner_id'
    ];
}
