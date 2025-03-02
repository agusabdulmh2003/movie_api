<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TicketController;

Route::prefix('movies')->group(function () {

    Route::get('/', [MovieController::class, 'index']);
    Route::post('/', [MovieController::class, 'store']);
    Route::get('/{id}', [MovieController::class, 'show']);
    Route::put('/{id}', [MovieController::class, 'update']);
    Route::delete('/{id}', [MovieController::class, 'destroy']);
});

Route::prefix('tickets')->group(function () {

    Route::get('/', [TicketController::class, 'index']);
    Route::post('/', [TicketController::class, 'store']);
});
