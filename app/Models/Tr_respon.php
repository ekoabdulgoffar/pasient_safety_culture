<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tr_respon extends Model
{
	public $timestamps = false;
    protected $table = 'tr_respon';
    protected $fillable = [
        'respon_id','user_id','respon_datetime'
    ];
}
