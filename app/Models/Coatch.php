<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coatch extends Model
{
    use HasFactory;
    protected $table = 'coatchs';
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'password',
        'avatar',
        'terms',
        'role',
        'sexe',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
