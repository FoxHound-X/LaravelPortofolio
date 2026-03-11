<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class user_data extends Authenticatable
{
    protected $table = 'user_datas';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
}
