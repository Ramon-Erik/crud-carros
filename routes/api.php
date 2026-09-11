<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

Route::get('/cars', [CarController::class, 'index']);
Route::get('/cars/{car}', [CarController::class, 'show']);

Route::post('/new-car', [CarController::class, 'store']);
Route::put('/car/{car}', [CarController::class, 'update']);
Route::delete('/car/{car}', [CarController::class, 'destroy']);
