<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ms_file_edukasi extends Model
{
	public $timestamps = false;
    protected $table = 'ms_file_edukasi';
    protected $fillable = [
        'edu_id','edu_desk_pdf','edu_file_pdf','edu_desk_video','edu_file_video'
    ];
}
