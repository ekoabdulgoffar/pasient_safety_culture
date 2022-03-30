<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ms_pertanyaan_post extends Model
{
    public $timestamps = false;
    protected $table = 'ms_pertanyaan_post';
    protected $fillable = [
        'pertanyaan_post_id','pertanyaan_post_','pertanyaan_post_pilihan',';pertanyaan_post_kunci'
    ];
}
