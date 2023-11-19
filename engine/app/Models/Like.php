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

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', '_id');
    }

    public function tweet()
    {
        return $this->belongsTo('App\Models\Tweet', 'tweet_id', '_id');
    }
}

