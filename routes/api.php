<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EventController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas de la API.
| Ejemplo: GET /api/events
|
*/

Route::prefix('api')->group(function () {
    Route::apiResource('events', EventController::class);
});