<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class RefreshToken extends Model
{
    protected $collection = 'refresh_tokens';

    protected $fillable = [
        'user_id', 'token', 'expires_at',
    ];

    protected $dates = ['created_at', 'expires_at'];
}
