<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\FuncionController;

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





