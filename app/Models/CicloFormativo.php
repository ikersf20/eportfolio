<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CicloFormativo extends Model
{
    use HasFactory;

    protected $table = 'ciclos_formativos';
    protected $fillable = [
        'familia_profesional_id',
        'nombre',
        'codigo',
        'grado',
        'descripcion',
    ];
    const GRADOS = [
        'BÁSICA',
        'G.M.',
        'G.S.',
        'C.E. (G.M.)',
        'C.E. (G.S.)',
    ];
}
