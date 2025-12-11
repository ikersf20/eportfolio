@extends('layouts.master')

@section('logo')
    <h1><a href="{{ url(config('app.url')) }}">Eportfolio Grupo 1 </a></h1>
    <p>Visualizacion de Familias Profesionales</p>
@endsection

@section('content')
    <div class="row m-4">
        <div class="col-12 col-sm-4">
            <a href="#" class="images featured"><img src="{{ asset('/images/logo.png') }}" alt="" style="width:15vh; height: 15vh;"/></a>
        </div>
        <div class="col-12 col-sm-8">

            <header>
                <h3>{{ $familia_profesional->nombre }}</h3>
                <h4>Codigo: {{$familia_profesional->codigo}}</h4>
                <p>Descripcion: {{$familia_profesional->descripcion}}</p>
            </header>
            <footer>
                <p></p>
                <ul class="actions">
                    @auth
                            <li><a href="{{ action([App\Http\Controllers\FamiliasProfesionalesController::class, 'getEdit'], $familia_profesional->id) }}" class="button alt">Editar Familia Profesional</a></li>
                    @endauth
                            <li><a href="{{ action([App\Http\Controllers\FamiliasProfesionalesController::class, 'getIndex']) }}" class="button alt">Todas los Familias Profesionales</a></li>
                </ul>
            </footer>

        </div>
    </div>
@endsection

@section('menu')
    <li>Opcion adicional</li>
@endsection
