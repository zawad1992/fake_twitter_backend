<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class User extends Model
{
    protected $collection = 'users';

    protected $fillable = [
        'user_name', 'email', 'password_hash', 'profile_info',
    ];

    protected $dates = ['created_at', 'updated_at'];
}