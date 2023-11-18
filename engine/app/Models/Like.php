<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Like extends Model
{
    protected $collection = 'likes';

    protected $fillable = [
        'user_id', 'tweet_id',
    ];

    protected $dates = ['created_at'];
}

