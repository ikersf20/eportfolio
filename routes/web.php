<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CiclosFormativosController;
use App\Http\Controllers\CriteriosEvaluacionController;
use App\Http\Controllers\ResultadosAprendizajeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FamiliasProfesionalesController;
use App\Http\Controllers\EvidenciasController;
use App\Http\Controllers\PortfolioImportController;

Route::get('/', [HomeController::class, 'getHome'])
->name('home');
Route::get('/criterios', [HomeController::class, 'getCriteriosEvaluacion']);
Route::get('/resultados', [HomeController::class, 'getResultadosAprendizaje']);
Route::get('/ciclos', [HomeController::class, 'getCiclosFormativos']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Formulario de importación
    Route::get('/portfolio/import', [PortfolioImportController::class, 'showImportForm'])
        ->name('portfolio.import.form');

    // Importar desde JSON Resume
    Route::post('/portfolio/import/json-resume', [PortfolioImportController::class, 'importJsonResume'])
        ->name('portfolio.import.json-resume');

    // Importar desde GitHub
    Route::post('/portfolio/import/github', [PortfolioImportController::class, 'importGitHub'])
        ->name('portfolio.import.github');
});

Route::prefix('familias-profesionales')->group(function () {
    Route::get('/', [FamiliasProfesionalesController::class, 'getIndex']) -> name('familias-profesionales.index');


    Route::get('/show/{id}', [FamiliasProfesionalesController::class, 'getShow']) -> where('id', '[0-9]+');


    Route::group(['middleware' => 'auth'], function(){
        Route::get('/edit/{id}', [FamiliasProfesionalesController::class, 'getEdit']) -> where('id', '[0-9]+');
        Route::post('store', [FamiliasProfesionalesController::class, 'store']);
        Route::put('update/{id}', [FamiliasProfesionalesController::class, 'update'])-> where('id', '[0-9]+');
        Route::get('create', [FamiliasProfesionalesController::class, 'getCreate']);
    });


});


Route::prefix('ciclos-formativos')->group(function(){
    Route::get('/', [CiclosFormativosController::class, 'getIndex']);

    Route::get('/show/{id}', [CiclosFormativosController::class, 'getShow']) -> where('id', '[0-9]+');

    Route::group(['middleware' => 'auth'], function(){
        Route::get('create', [CiclosFormativosController::class, 'getCreate']);
        Route::get('/edit/{id}', [CiclosFormativosController::class, 'getEdit']) -> where('id', '[0-9]+');
        Route::post('store', [CiclosFormativosController::class, 'store']);
        Route::put('update/{id}', [CiclosFormativosController::class, 'update'])-> where('id', '[0-9]+');
    });
});

Route::prefix('criterios-evaluacion')->group(function () {
    Route::get('/', [CriteriosEvaluacionController::class, 'getIndex']);

    Route::get('/show/{id}', [CriteriosEvaluacionController::class, 'getShow']) -> where('id', '[0-9]+');

    Route::group(['middleware' => 'auth'], function(){
        Route::get('create', [CriteriosEvaluacionController::class, 'getCreate']);
        Route::get('/edit/{id}', [CriteriosEvaluacionController::class, 'getEdit']) -> where('id', '[0-9]+');
        Route::post('store', [CriteriosEvaluacionController::class, 'store']);
        Route::put('update/{id}', [CriteriosEvaluacionController::class, 'update'])-> where('id', '[0-9]+');
    });
});


Route::prefix('resultados-aprendizaje')->group(function () {
    Route::get('/', [ResultadosAprendizajeController::class, 'getIndex']);

        Route::get('/show/{id}', [ResultadosAprendizajeController::class, 'getShow']) -> where('id', '[0-9]+');

    Route::group(['middleware' => 'auth'], function(){
        Route::get('create', [ResultadosAprendizajeController::class, 'getCreate']);
        Route::get('/edit/{id}', [ResultadosAprendizajeController::class, 'getEdit']) -> where('id', '[0-9]+');
        Route::post('store', [ResultadosAprendizajeController::class, 'store']);
        Route::put('update/{id}', [ResultadosAprendizajeController::class, 'update'])-> where('id', '[0-9]+');
    });
});

Route::prefix('evidencias')->group(function () {
    Route::get('/', [EvidenciasController::class, 'getIndex']);

        Route::get('/show/{id}', [EvidenciasController::class, 'getShow']) -> where('id', '[0-9]+');

    Route::group(['middleware' => 'auth'], function(){
        Route::get('create', [EvidenciasController::class, 'getCreate']);
        Route::get('/edit/{id}', [EvidenciasController::class, 'getEdit']) -> where('id', '[0-9]+');
        Route::post('store', [EvidenciasController::class, 'store']);
        Route::put('update/{id}', [EvidenciasController::class, 'update'])-> where('id', '[0-9]+');
    });
});

require __DIR__.'/auth.php';
