<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tr_edukasi extends Model
{
    public $timestamps = false;
    protected $table = 'tr_edukasi';
    protected $primaryKey = 'tr_edu_id';
    protected $fillable = [
        'edu_id','user_id','tr_edu_isPdf','tr_edu_isVideo','datetime_update'
    ];
}
