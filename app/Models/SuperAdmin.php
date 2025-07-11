<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class SuperAdmin extends Authenticatable
{
    use HasFactory,HasApiTokens;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'password',
        'avatar',
        'role',
        'remember_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
