<?php
//use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Route;
use Tasmir\LaravelMedia\Http\Controllers\LaravelMediaController;

//Route::get('media', function (){
//    return config('media.empty_url');
//    return view("laravelmedia::index");
//});
Route::get('media', [LaravelMediaController::class, 'index']);
Route::get('fetch-media', [LaravelMediaController::class, 'getAllMedia']);
Route::post('media-upload', [LaravelMediaController::class, 'store']);

//Route::get('media/{media}', [LaravelMediaController::class, 'show']);

Route::get('media/file/{media}',[LaravelMediaController::class, 'media_url'])->name("media.file");

//Route::get('/media/{media}', function (\Tasmir\LaravelMedia\Models\Media $media) {
//    dd($media) ;
//});
