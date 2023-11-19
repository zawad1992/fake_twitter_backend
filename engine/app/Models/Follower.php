<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Follower extends Model
{
    protected $collection = 'follows';

    protected $fillable = [
        'follower_id', 'followed_id',
    ];

    protected $dates = ['created_at'];

    public function follower()
    {
        return $this->belongsTo('App\Models\User', 'follower_id', '_id');
    }

    public function followed()
    {
        return $this->belongsTo('App\Models\User', 'followed_id', '_id');
    }
}