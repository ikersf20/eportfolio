<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluacion extends Model
{
    /** @use HasFactory<\Database\Factories\EvaluacionFactory> */
    use HasFactory;

    const ESTADOS = [
        'pendiente',
        'aprobado',
        'suspenso'
    ];
    protected $table = 'evaluaciones';
        protected $fillable = [
                'evidencia_id',
                'user_id',
                'puntuacion',
                'estado',
                'observaciones'
        ];
}
