<?php
//use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Route;
use Tasmir\LaravelMedia\Http\Controllers\LaravelMediaController;

Route::prefix('/library')->group(function () {
    Route::get('media', [LaravelMediaController::class, 'index']);
    Route::get('fetch-media', [LaravelMediaController::class, 'getAllMedia']);
    Route::post('media-upload', [LaravelMediaController::class, 'store']);
});
Route::get('media/file/{media}',[LaravelMediaController::class, 'media_url'])->name("media.file");
