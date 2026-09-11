<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/users', [CarController::class, 'index']);
Route::get('/admin/users/{user}', [CarController::class, 'show']);
