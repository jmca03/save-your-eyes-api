<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Global render
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\HttpException $exception, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {

                $statusCode = $exception?->getStatusCode() ?? $exception?->getCode() ?: 500;
                return (new class {
                    use \App\Traits\JsonResponseFormatter;
                })->jsonResponse(
                    data      : [],
                    statusCode: $statusCode,
                    message   : $exception->getMessage() ?: __("responses.api.{$statusCode}"),
                );
            }

            return response($exception->getMessage(), 500);
        });

        // If exception came from AuthorizationRequests of Policy
        $exceptions->render(
            fn(\Illuminate\Auth\Access\AuthorizationException $exception, \Illuminate\Http\Request $request) => $request->is('api/*')
                ? (new class {
                    use \App\Traits\ErrorJsonResponseFormatter;
                })->jsonForbiddenResponse(
                    message: $exception?->getMessage() ?: __("responses.api.403"),
                )
                : response($exception->getMessage(), 403)
        );

        // If exception is ModelNotFoundException, use 404
        $exceptions->render(
            fn(\Illuminate\Database\Eloquent\ModelNotFoundException $exception, \Illuminate\Http\Request $request) => $request->is('api/*')
                ? (new class {
                    use \App\Traits\ErrorJsonResponseFormatter;
                })->jsonNotFoundResponse(
                    message: $exception->getMessage() ?: __("responses.api.404"),
                )
                : response($exception->getMessage(), 404)
        );

        // Global Context
        $exceptions->context(fn(\Illuminate\Http\Request $request) => [
            'authId'    => auth()->check() ? auth()->id() : null,
            'payload'   => $request->toArray(),
            'ipAddress' => $request->ip(),
            'userAgent' => $request->userAgent(),
            'timestamp' => now()->format('Y-m-d H:i:s'),
        ]);
    })->create();
