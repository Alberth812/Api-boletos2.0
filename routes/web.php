<?php

use Illuminate\Support\Facades\Route;

// Deja este archivo vacío o con una ruta de prueba
Route::get('/', function () {
    return response()->json(['message' => 'API de Boletos v2.0']);
});