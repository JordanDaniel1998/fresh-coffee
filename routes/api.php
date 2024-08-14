<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/* De esta forma se tiene que declarar los metodos uno por uno */
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
/* De esta forma te ofrece métodos ya creados dentro del controlador */
Route::apiResource('/pedidos', PedidoController::class)->middleware('auth:sanctum');

/* Route::get('/categorias', [CategoriaController::class, 'index']); */
Route::apiResource('/categorias', CategoriaController::class)->middleware('auth:sanctum');
Route::apiResource('/productos', ProductoController::class)->middleware('auth:sanctum');


/* Autenticación */
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
