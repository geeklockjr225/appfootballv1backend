<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clubs extends Model
{
    use HasFactory; 
    protected $table = 'clubs';
    protected $fillable = [
        'name',
        'address',
        'email',
        'phone',
        'logo',
        'description',
    ];

}
