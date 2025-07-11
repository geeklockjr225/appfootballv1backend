<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Parents extends Model
{
    use HasFactory,HasApiTokens,Notifiable;
    protected $table = 'parents';
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
    public function joueurs()
    {
        return $this->hasMany(Joeur::class, 'parent_id');
    }



    protected $hidden = [
        'password',
        'remember_token',
    ];
}
