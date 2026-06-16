<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\FuncionController;
use App\Http\Controllers\NegociosController;
use App\Http\Controllers\VisitasController;


Route::get('/', [NegociosController::class, 'create']);

Route::get('/negocios', [NegociosController::class, 'index']);
Route::get('/negocios/show', [NegociosController::class, 'index']);
Route::get('/negocios/create', [NegociosController::class, 'create']);
Route::post('/negocios/store', [NegociosController::class, 'store']);
Route::get('/negocios/edit/{id}', [NegociosController::class, 'edit']);
Route::post('/negocios/update/{id}', [NegociosController::class, 'update']);
/* ;
Route::get('/negocios/show/{id}', [NegociosController::class, 'show']);


Route::get('/negocios/destroy/{id}', [NegociosController::class, 'destroy']); */


Route::get('/visitas', [VisitasController::class, 'index']);
Route::get('/visitas/show', [VisitasController::class, 'index']);
Route::get('/visitas/create', [VisitasController::class, 'create']);
Route::post('/visitas/store', [VisitasController::class, 'store']);


/* 


Route::get('/visitas/show/{id}', [VisitasController::class, 'show']);
Route::get('/visitas/edit/{id}', [VisitasController::class, 'edit']);
Route::post('/visitas/update/{id}', [VisitasController::class, 'update']); 
*/





