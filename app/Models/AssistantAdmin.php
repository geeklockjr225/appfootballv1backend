<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistantAdmin extends Model
{
    use HasFactory;
    protected $table = 'assistantAdmin';
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
        return $this->belongsTo(User::class, 'parent_id');
    }
}
