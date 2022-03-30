<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dt_post_test extends Model
{
	public $timestamps = false;
    protected $table = 'dt_post_test';
    protected $fillable = [
        'dtpost_test_id','post_test_id','pertanyaan_post_id'
    ];
}
