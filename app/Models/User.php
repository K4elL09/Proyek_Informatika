<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    
    protected $fillable = ['name', 'email', 'username', 'password'];
    protected $hidden = ['password'];
}