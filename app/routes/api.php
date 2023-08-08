<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::middleware('api')->group(function () {
    Route::prefix('ticket')->group(function () {
        Route::get('/search', [TicketController::class, 'search']);
    });
});
