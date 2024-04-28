<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefreshToken extends Model
{
    // Define the table associated with the model.
    protected $table = 'refresh_tokens';

    // Define the primary key and set it to auto-increment.
    protected $primaryKey = '_id';
    public $incrementing = true;
    protected $keyType = 'int';

    // The attributes that are mass assignable.
    protected $fillable = [
        'user_id', 'token', 'expires_at',
    ];

    // The attributes that should be cast.
    protected $casts = [
        'expires_at' => 'datetime',
    ];

    // The dates that are automatically treated as Carbon instances.
    protected $dates = ['created_at', 'expires_at'];
}
