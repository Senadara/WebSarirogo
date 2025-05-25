<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable 
{
    use HasFactory, Notifiable;
    protected $fillable = ['username', 'email', 'password', 'name', 'role_id'];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function getUserName(): string
    {
        return $this->username;
    }
    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
