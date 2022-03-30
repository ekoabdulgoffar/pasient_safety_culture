<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ms_post_test extends Model
{
    public $timestamps = false;
    protected $table = 'ms_post_test';
    protected $fillable = [
        'post_test_id','post_test_deskripsi','post_test_datetime'
    ];
}
