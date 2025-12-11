<?php

use App\Http\Controllers\CiclosFormativosController;
use App\Http\Controllers\CriteriosEvaluacionController;
use App\Http\Controllers\ResultadosAprendizajeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FamiliasProfesionalesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [HomeController::class, 'getHome'])->name('home');
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
});



// ----------------------------------------
Route::prefix('familias-profesionales')->group(function () {
    Route::get('/', [FamiliasProfesionalesController::class, 'getIndex']);

    Route::get('/show/{id}', [FamiliasProfesionalesController::class, 'getShow']) -> where('id', '[0-9]+');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('create', [FamiliasProfesionalesController::class, 'getCreate']);
        Route::get('/edit/{id}', [FamiliasProfesionalesController::class, 'getEdit']) -> where('id', '[0-9]+');
        Route::post('postCreate', [FamiliasProfesionalesController::class, 'postCreate']);
        Route::put('putCreate/{id}', [FamiliasProfesionalesController::class, 'putCreate'])-> where('id', '[0-9]+');
    });


});


Route::prefix('ciclos-formativos')->group(function(){
    Route::get('/', [CiclosFormativosController::class, 'getIndex']);

    Route::get('/show/{id}', [CiclosFormativosController::class, 'getShow']) -> where('id', '[0-9]+');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('create', [CiclosFormativosController::class, 'getCreate']);
        Route::get('/edit/{id}', [CiclosFormativosController::class, 'getEdit']) -> where('id', '[0-9]+');
        Route::post('postCreate', [CiclosFormativosController::class, 'postCreate']);
        Route::put('putCreate/{id}', [CiclosFormativosController::class, 'putCreate'])-> where('id', '[0-9]+');
    });
});

Route::prefix('criterios-evaluacion')->group(function () {
    Route::get('/', [CriteriosEvaluacionController::class, 'getIndex']);

    Route::get('/show/{id}', [CriteriosEvaluacionController::class, 'getShow']) -> where('id', '[0-9]+');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('create', [CriteriosEvaluacionController::class, 'getCreate']);
        Route::get('/edit/{id}', [CriteriosEvaluacionController::class, 'getEdit']) -> where('id', '[0-9]+');
        Route::post('postCreate', [CriteriosEvaluacionController::class, 'postCreate']);
        Route::put('putCreate/{id}', [CriteriosEvaluacionController::class, 'putCreate'])-> where('id', '[0-9]+');
    });

});


Route::prefix('resultados-aprendizaje')->group(function () {
    Route::get('/', [ResultadosAprendizajeController::class, 'getIndex']);

    Route::get('/show/{id}', [ResultadosAprendizajeController::class, 'getShow']) -> where('id', '[0-9]+');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('create', [ResultadosAprendizajeController::class, 'getCreate']);
        Route::get('/edit/{id}', [ResultadosAprendizajeController::class, 'getEdit']) -> where('id', '[0-9]+');
        Route::post('postCreate', [ResultadosAprendizajeController::class, 'postCreate']);
        Route::put('putCreate/{id}', [ResultadosAprendizajeController::class, 'putCreate'])-> where('id', '[0-9]+');
    });


});

require __DIR__.'/auth.php';
