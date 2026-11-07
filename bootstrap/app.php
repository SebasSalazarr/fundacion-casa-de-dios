<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Wompi no puede enviar token CSRF; sus eventos se validan con firma.
        $middleware->validateCsrfTokens(except: ['wompi/eventos']);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Un formulario de donar vencido (419) vuelve al formulario, no a una página de error.
        $exceptions->render(function (HttpException $e, Request $request) {
            if ($e->getStatusCode() === 419 && $request->is('donar')) {
                return redirect(route('inicio').'#donar');
            }
        });

        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
