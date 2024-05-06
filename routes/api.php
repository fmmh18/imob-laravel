<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('listar-fotos/{id}', [App\Http\Controllers\api\fotoController::class, 'listarFotos'])->name('api.listar.fotos');
Route::get('excluir-foto', [App\Http\Controllers\api\fotoController::class, 'excluirFoto'])->name('api.excluir.foto');

Route::get('cidade-por-estado', [App\Http\Controllers\api\cityController::class, 'cityByState'])->name('api.cityByState');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
