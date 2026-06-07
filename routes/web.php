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
Route::get('/negocios/show/{id}', [NegociosController::class, 'show']);
Route::get('/negocios/edit/{id}', [NegociosController::class, 'edit']);
Route::post('/negocios/update/{id}', [NegociosController::class, 'update']);
Route::get('/negocios/destroy/{id}', [NegociosController::class, 'destroy']);

Route::get('/visitas', [VisitasController::class, 'index']);
Route::get('/visitas/show', [VisitasController::class, 'index']);
Route::get('/visitas/create', [VisitasController::class, 'create']);
Route::post('/visitas/store', [VisitasController::class, 'store']);
Route::get('/visitas/show/{id}', [VisitasController::class, 'show']);
Route::get('/visitas/edit/{id}', [VisitasController::class, 'edit']);
Route::post('/visitas/update/{id}', [VisitasController::class, 'update']);
Route::get('/cursos/destroy/{id}', [VisitasController::class, 'destroy']);


Route::get('/cursos', [CursoController::class, 'index']);
Route::get('/cursos/show', [CursoController::class, 'index']);
Route::get('/cursos/create', [CursoController::class, 'create']);
Route::post('/cursos/store', [CursoController::class, 'store']);
Route::get('/cursos/show/{id}', [CursoController::class, 'show']);
Route::get('/cursos/edit/{id}', [CursoController::class, 'edit']);
Route::post('/cursos/update/{id}', [CursoController::class, 'update']);
Route::get('/cursos/destroy/{id}', [CursoController::class, 'destroy']);

Route::get('/estudiantes', [EstudianteController::class, 'index']);
Route::get('/estudiantes/show', [EstudianteController::class, 'index']);
Route::get('/estudiantes/create', [EstudianteController::class, 'create']);
Route::post('/estudiantes/store', [EstudianteController::class, 'store']);
Route::get('/estudiantes/show/{id}', [EstudianteController::class, 'show']);
Route::get('/estudiantes/edit/{id}', [EstudianteController::class, 'edit']);
Route::post('/estudiantes/update/{id}', [EstudianteController::class, 'update']);
Route::get('/estudiantes/destroy/{id}', [EstudianteController::class, 'destroy']);

Route::get('/funciones/asignarCursos', [FuncionController::class, 'asignarCursos']);
Route::post('/funciones/store', [FuncionController::class, 'store']);
Route::get('/funciones/estudianteCurso/{id}', [FuncionController::class, 'estudianteCurso']);
Route::get('/funciones/top3', [FuncionController::class, 'top3']);





