<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    // Define the table associated with the model.
    protected $table = 'followers';  // Adjust the table name if needed

    // Define the primary key and set it to auto-increment.
    protected $primaryKey = '_id';
    public $incrementing = true;
    protected $keyType = 'int';

    // The attributes that are mass assignable.
    protected $fillable = [
        'follower_id', 'followed_id',
    ];

    // The dates that are automatically treated as Carbon instances.
    protected $dates = ['created_at'];

    // Define the relationship with the User model for follower.
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id', '_id');
    }

    // Define the relationship with the User model for followed.
    public function followed()
    {
        return $this->belongsTo(User::class, 'followed_id', '_id');
    }
}
