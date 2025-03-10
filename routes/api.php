<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

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


Route::prefix('seats')->group(function () {
    Route::get('/', [SeatController::class, 'index']);
    Route::post('/', [SeatController::class, 'store']);
    Route::put('/{id}', [SeatController::class, 'update']);
    Route::delete('/{id}', [SeatController::class, 'destroy']);
});


Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::post('/', [OrderController::class, 'store']);
    Route::put('/{id}', [OrderController::class, 'update']);
    Route::delete('/{id}', [OrderController::class, 'destroy']);
});


Route::post('/payment', [PaymentController::class, 'createTransaction']);
Route::post('/payment/notification', [PaymentController::class, 'handleNotification']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('movies/{id}/rate', [RatingController::class, 'rateMovie']);
    Route::get('movies/{id}/ratings', [RatingController::class, 'getMovieRatings']);
    Route::get('movies/recommended', [MovieController::class, 'getRecommendedMovies']);
    Route::get('movies/trending', [MovieController::class, 'getTrendingMovies']);

    Route::get('statistics/movie-sales', [StatisticsController::class, 'movieSales']);
    Route::get('statistics/daily-sales', [StatisticsController::class, 'dailySales']);
    Route::get('statistics/monthly-revenue', [StatisticsController::class, 'monthlyRevenue']);
    Route::get('statistics/movie-viewers', [StatisticsController::class, 'movieViewers']);
});
