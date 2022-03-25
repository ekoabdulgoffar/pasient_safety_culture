<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
	public $timestamps = false;
    protected $table = 'ms_user';
    protected $fillable = [
        'user_id','rw_id','user_username','user_password','user_email','user_name','user_phone','user_status','user_created_by','user_modified_by','user_created_date','user_modified_date','user_role'
    ];
}
