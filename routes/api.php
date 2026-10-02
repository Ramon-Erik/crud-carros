<?php

use App\Http\Controllers\CarController;
use App\Support\Models\ApiResponse;
use Illuminate\Support\Facades\Route;

Route::prefix('car')->group(function () {
    Route::post('cadastrar', [CarController::class, 'cadastrar']);
    Route::get('listagem', [CarController::class, 'listagem']);
    Route::get('listar/{id}', [CarController::class, 'listar']);
//    Route::post('editar', [CarController::class, '']);
    Route::post('deletar/{id}', [CarController::class, 'deletar']);
});


Route::fallback(function () {
    return ApiResponse::build()
        ->setCode(404)
        ->setMessage('Rota não encontrada')
        ->setErrors([
                'url' => request()->fullUrl()
            ]
        )
        ->response();
});
