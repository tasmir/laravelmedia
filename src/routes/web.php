<?php

use Tasmir\LaravelMedia\Controllers;
use Illuminate\Support\Facades\Route;
use Tasmir\LaravelMedia\Controllers\LaravelMediaController;

Route::get('inspire', [LaravelMediaController::class, 'index']);
