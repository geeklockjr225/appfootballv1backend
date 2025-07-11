<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admins';
    protected $fillable = [
        'user_id',
        'club_id',
        'full_name',
        'admin_email',
        'admin_phone',
        'password',
        'avatar',
        'terms',
        'role',
        'sexe',
    ];
}
