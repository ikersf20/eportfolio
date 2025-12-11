@extends('layouts.master')

@section('logo')
    <h1><a href="{{ url(config('app.url')) }}">Eportfolio Grupo 1 </a></h1>
    <p>Visualizacion de Criterios de Evaluacion </p>
@endsection

@section('content')
    <div class="row m-4">
        <div class="col-12 col-sm-4">
            <a href="#" class="images featured"><img src="{{ asset('/images/logo.png') }}" alt="" style="width:15vh; height: 15vh;"/></a>
        </div>
        <div class="col-12 col-sm-8">
            <header style="max-width: 100vh;">
                <h2>Codigo: {{ $criterio_evaluacion->codigo }}</h2>
                <h4>Descripción: {{$criterio_evaluacion->descripcion}}</h4>
                <h4>Fecha de creación: {{ $criterio_evaluacion->created_at }}</h4>
                <h4>Fecha de actualización: {{ $criterio_evaluacion->updated_at }}</h4>
                <h5>Porcentaje: {{ $criterio_evaluacion->peso_porcentaje }} %</h5>

            </header>
            <footer>
                <p></p>
                <ul class="actions">
                    @auth
                            <li><a href="{{ action([App\Http\Controllers\CriteriosEvaluacionController::class, 'getEdit'], $criterio_evaluacion->id) }}" class="button alt">Editar Criterio de Evaluación</a></li>
                    @endauth
                            <li><a href="{{ action([App\Http\Controllers\CriteriosEvaluacionController::class, 'getIndex']) }}" class="button alt">Todas los Criterios de Evaluación</a></li>
                </ul>
            </footer>

        </div>
    </div>
@endsection

@section('menu')
    <li>Opcion adicional</li>
@endsection
