<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tr_respon_post extends Model
{
	public $timestamps = false;
    protected $table = 'tr_respon_post';
    protected $fillable = [
        'respon_post_id','user_id','respon_post_status','respon_post_datetime'
    ];
}
