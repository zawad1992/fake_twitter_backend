<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Tweet extends Model
{
    protected $collection = 'tweets';

    protected $fillable = [
        'user_id', 'content', 'likes_count',
    ];

    protected $dates = ['created_at'];
}
