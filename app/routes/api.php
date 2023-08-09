<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;

Route::middleware('api')->group(function () {
    Route::prefix('ticket')->group(function () {
        Route::get('/', [TicketController::class, 'index']);
        Route::get('/search', [TicketController::class, 'search']);
    });
    Route::prefix('auth')->group(function () {
        Route::post('/register', [UserController::class, 'register']);
        Route::post('/login', [UserController::class, 'login']);
        Route::post('/logout', [UserController::class, 'logout']);
    });
});
