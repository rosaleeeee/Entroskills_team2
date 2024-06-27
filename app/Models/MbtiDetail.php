<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MbtiDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'E_start',
        'I_start',
        'S_start',
        'N_start',
        'T_start',
        'F_start',
        'J_start',
        'P_start',
        'E_level4',
        'I_level4',
        'S_level4',
        'N_level4',
        'T_level4',
        'F_level4',
        'J_level4',
        'P_level4',
    ];

    // Vous pouvez définir d'autres relations ou méthodes ici si nécessaire
}

