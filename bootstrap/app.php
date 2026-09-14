<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use \Illuminate\Validation\ValidationException;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \App\Helpers\ApiResponse;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
//        $exceptions->shouldRenderJsonWhen(
//            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
//        );
        $exceptions->render(function (ValidationException $e, Request $request) {
            return ApiResponse::error('Dados inválidos', 422, $e->errors());
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return ApiResponse::error('Não encontrado', 404);
        });
    })->create();
