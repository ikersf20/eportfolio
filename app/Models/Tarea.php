<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarea extends Model
{

    /** @use HasFactory<\Database\Factories\TareaFactory> */
    use HasFactory;

    protected $table = 'tareas';
    protected $fillable = [
            'criterio_evaluacion_id',
            'fecha_apertura',
            'fecha_cierre',
            'activo',
            'enunciado'
    ];
}
