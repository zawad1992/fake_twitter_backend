<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Follow extends Model
{
    protected $collection = 'follows';

    protected $fillable = [
        'follower_id', 'followed_id',
    ];

    protected $dates = ['created_at'];
}