<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $fillable = [
        'sejarah',
        'visi',
        'misi',
        'tupoksi',
        'foto_gedung'
    ];
}
