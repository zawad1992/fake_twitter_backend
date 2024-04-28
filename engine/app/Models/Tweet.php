<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    // The table associated with the model.
    protected $table = 'tweets';

    // The primary key for the table.
    protected $primaryKey = '_id';
    public $incrementing = true;
    protected $keyType = 'int';

    // The attributes that are mass assignable.
    protected $fillable = [
        'user_id', 'content', 'likes_count',
    ];

    // The attributes that should be cast.
    protected $casts = [
        'likes_count' => 'integer',
    ];

    // Define the relationship with the User model.
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }

    // Define the relationship with the Like model.
    public function likes()
    {
        return $this->hasMany('App\Models\Like', 'tweet_id', '_id');
    }
}
