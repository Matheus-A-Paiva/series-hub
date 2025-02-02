<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\SerieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('series')->group(function () {
    Route::get('/discover', [SerieController::class, 'searchSeriesByGenre']);
    Route::get('/search', [SerieController::class, 'searchSeries']);
    Route::get('/', [SerieController::class, 'index']);
    Route::get('/{serieId}', [SerieController::class, 'show']);
});

Route::prefix('genres')->group(function () {
   Route::get('/', [GenreController::class, 'index']);
});
