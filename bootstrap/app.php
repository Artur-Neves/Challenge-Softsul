<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: [
            'path' => '/api',
            'file' => __DIR__ . '/../routes/api.php',
        ],
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                $statusCode = 500;
                $error = 'Internal Server Error';
                $message = $e->getMessage() ?: 'Ocorreu um erro inesperado.';

                if ($e instanceof NotFoundHttpException) {
                    $pervios = $e->getPrevious();
                    if ($pervios instanceof ModelNotFoundException) {
                        $statusCode = 404;
                        $error = 'Model Not Found';
                        $modelName = strtolower(class_basename($pervios->getModel()));
                        $message = "Não existe nenhum(a) {$modelName} com este identificador.";
                    } else {
                        $statusCode = 404;
                        $error = 'Not Found';
                        $message = 'A página que você está procurando não existe.';
                    }
                } elseif ($e instanceof \Illuminate\Auth\AuthenticationException) {
                    $statusCode = 401;
                    $error = 'Unauthorized';
                    $message = 'Acesso negado. É necessário autenticação.';
                } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException) {
                    $statusCode = 403;
                    $error = 'Forbidden';
                    $message = 'Você não tem permissão para acessar este recurso.';
                } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
                    $statusCode = 405;
                    $error = 'Method Not Allowed';
                    $message = 'O método da requisição não é permitido para esta rota.';
                } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException) {
                    $statusCode = 429;
                    $error = 'Too Many Requests';
                    $message = 'Você excedeu o limite de requisições. Por favor, tente novamente mais tarde.';
                }

                return response()->json([
                    'status' => $statusCode,
                    'error' => $error,
                    'message' => $message
                ], $statusCode);
            }
        });
    })->create();
