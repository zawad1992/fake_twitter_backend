<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // Define the table associated with the model.
    protected $table = 'likes';

    // Define the primary key and set it to auto-increment.
    protected $primaryKey = '_id';
    public $incrementing = true;
    protected $keyType = 'int';

    // The attributes that are mass assignable.
    protected $fillable = [
        'user_id', 'tweet_id',
    ];

    // The dates that are automatically treated as Carbon instances.
    protected $dates = ['created_at'];

    // Define the relationship with the User model.
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', '_id');
    }

    // Define the relationship with the Tweet model.
    public function tweet()
    {
        return $this->belongsTo(Tweet::class, 'tweet_id', '_id');
    }
}
