<?php

namespace App\Exceptions;

use App\Infrastructure\Exceptions\ApiException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void {}

    public function render($request, Throwable $e)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            return $this->renderForApi($request, $e);
        }

        return parent::render($request, $e);
    }

    private function renderForApi($request, Throwable $e)
    {
        $status = 500;
        $payload = [
            'status' => 'error',
            'message' => 'An unexpected error occurred.',
        ];

        if ($e instanceof ValidationException) {
            $status = $e->status;
            $payload['message'] = 'Validation failed.';
            $payload['errors'] = $e->errors();
        } elseif ($e instanceof AuthenticationException) {
            $status = 401;
            $payload['message'] = $e->getMessage() ?: 'Unauthenticated.';
        } elseif ($e instanceof AuthorizationException) {
            $status = 403;
            $payload['message'] = $e->getMessage() ?: 'This action is unauthorized.';
        } elseif ($e instanceof ModelNotFoundException) {
            $status = 404;
            $payload['message'] = 'Resource not found.';
        } elseif ($e instanceof ApiException) {
            $status = $e->status();
            $payload['message'] = $e->getMessage();
            if ($e->errors()) {
                $payload['errors'] = $e->errors();
            }
        } elseif ($e instanceof HttpExceptionInterface) {
            $status = $e->getStatusCode();
            $payload['message'] = $e->getMessage() ?: 'HTTP error.';

            return response()->json($payload, $status, $e->getHeaders());
        }

        if (config('app.debug')) {
            $payload['exception'] = class_basename($e);
        }

        return response()->json($payload, $status);
    }
}

