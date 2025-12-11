@extends('layouts.master')

@section('logo')
    <h1><a href="{{ url(config('app.url')) }}">Eportfolio Grupo 1 </a></h1>
    <p>Visualizacion de Resultados de Aprendizaje </p>
@endsection

@section('content')
    <div class="row m-4">
        <div class="col-12 col-sm-4">
            <a href="#" class="images featured"><img src="{{ asset('/images/logo.png') }}" alt="" style="width:15vh; height: 15vh;"/></a>
        </div>
        <div class="col-12 col-sm-8">

            <header style="max-width: 100vh;">
                <h2>Codigo: {{ $resultado_aprendizaje->codigo }}</h2>
                <h4>Descripción: {{$resultado_aprendizaje->descripcion}}</h4>
                <h4>Fecha de creación: {{ $resultado_aprendizaje->created_at }}</h4>
                <h4>Fecha de actualización: {{ $resultado_aprendizaje->updated_at }}</h4>
                <h5>Porcentaje: {{ $resultado_aprendizaje->peso_porcentaje }}%</h5>

            </header>
            <footer>
                <p></p>
                <ul class="actions">
                    @auth
                            <li><a href="{{ action([App\Http\Controllers\ResultadosAprendizajeController::class, 'getEdit'], $resultado_aprendizaje->id) }}" class="button alt">Editar Resultado de Aprendizaje</a></li>
                    @endauth
                            <li><a href="{{ action([App\Http\Controllers\ResultadosAprendizajeController::class, 'getIndex']) }}" class="button alt">Todos los Resultados de Aprendizaje</a></li>
                </ul>
            </footer>

        </div>
    </div>
@endsection

@section('menu')
    <li>Opcion adicional</li>
@endsection
