<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\ArtistController;
use App\Http\Controllers\API\TicketTypeController;
use App\Http\Controllers\API\PurchaseController;
use App\Http\Controllers\API\TicketController;
use App\Http\Controllers\API\DiscountController;
use App\Http\Controllers\API\TicketPackageController;
use App\Http\Controllers\API\UserController;

Route::prefix('api')->group(function () {
    // 🔓 Rutas públicas
    Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
});

// 🔐 Rutas protegidas por autenticación
Route::middleware('auth:sanctum')->group(function () {

    // 🛡️ Solo admins pueden crear, editar, eliminar
    Route::middleware(['role:true'])->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('events', EventController::class);
        Route::apiResource('locations', LocationController::class);
        Route::apiResource('artists', ArtistController::class);
        Route::apiResource('ticket-types', TicketTypeController::class);
        Route::apiResource('purchases', PurchaseController::class);
        Route::apiResource('tickets', TicketController::class);
        Route::apiResource('discounts', DiscountController::class);
        Route::apiResource('ticket-packages', TicketPackageController::class);
    });

    // 🧑‍💼 Rutas accesibles para cualquier usuario autenticado
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});