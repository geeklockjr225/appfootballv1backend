<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joeur extends Model
{
    use HasFactory;
    protected $table = 'joueurs';
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'avatar',
        'terms',
        'sexe',
        'date_de_naissance',
        'classe',
        'antecedent',
        'categorie',
        'taille',
        'poids',
        'position'
    ];

    public function parent()
    {
        return $this->belongsTo(Parent::class, 'parent_id');
    }
}
