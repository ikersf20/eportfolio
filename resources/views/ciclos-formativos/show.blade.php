@extends('layouts.master')

@section('logo')
    <h1><a href="{{ url(config('app.url')) }}">Eportfolio Grupo 1</a></h1>
    <p>Entorno Servidor: Trabajo En Grupo</p>
@endsection

@section('content')

    <div class="row m-0">
        <div class="col-12 col-sm-4">
            <a href="#" class="image"><img src="{{ asset('/images/logo.png') }}" alt=""
                    style="width: 15vh; height: 15vh;" /></a>
        </div>
        <div class="col-12 col-sm-8">

            <header>
                <h3>{{ $ciclo_formativo->nombre }}</h3>
                <h4>Codigo: {{$ciclo_formativo->codigo}}</h4>
                <h5>Grado: {{$ciclo_formativo->grado}}</h5>
                <p>Descripción: {{$ciclo_formativo->descripcion}}</p>
            </header>
            <footer>
                <p></p>
                <ul class="actions">
                    @auth
                    <li><a href="{{ action([App\Http\Controllers\CiclosFormativosController::class, 'getEdit'], ['id' => $ciclo_formativo->id]) }}"
                            class="button alt">Editar Ciclo Formativo</a></li>
                    @endauth
                    <li><a href="{{ action([App\Http\Controllers\CiclosFormativosController::class, 'getIndex']) }}"
                            class="button alt">Todos los Ciclos Formativos</a></li>
                </ul>
            </footer>

        </div>
    </div>
@endsection

@section('menu')
    <li>Opcion adicional</li>
@endsection
