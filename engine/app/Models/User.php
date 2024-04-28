<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    // Set the table name if it's different from the model name in plural
    protected $table = 'users';

    // Primary key
    protected $primaryKey = '_id';
    public $incrementing = true;
    protected $keyType = 'int';

    // The attributes that are mass assignable.
    protected $fillable = [
        'name', 'email', 'password', 'profile_info',
    ];

    // The attributes that should be hidden for serialization.
    protected $hidden = [
        'password', 'remember_token',
    ];

    // The attributes that should be cast.
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Get the identifier that will be stored in the subject claim of the JWT.
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Return a key value array, containing any custom claims to be added to the JWT.
    public function getJWTCustomClaims()
    {
        return [];
    }

    // Define relationships
    public function tweets()
    {
        return $this->hasMany('App\Models\Tweet', 'user_id', '_id');
    }
    public function followers()
    {
        return $this->hasMany('App\Models\Follower', 'followed_id', '_id');
    }
    public function following()
    {
        return $this->hasMany('App\Models\Follower', 'follower_id', '_id');
    }
}
