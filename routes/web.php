<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EventController;

// Ruta principal (página de bienvenida)
Route::get('/', function () {
    return view('welcome');
});

// Grupo de rutas API
Route::prefix('api')->group(function () {
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{id}', [EventController::class, 'show']);
});