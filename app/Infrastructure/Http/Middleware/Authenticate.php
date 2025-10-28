<?php
namespace App\Infrastructure\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as BaseAuthenticate;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends BaseAuthenticate
{
    protected function unauthenticated($request, array $guards)
    {
        if ($this->shouldReturnJson($request)) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated.',
            ], Response::HTTP_UNAUTHORIZED));
        }

        parent::unauthenticated($request, $guards);
    }

    protected function redirectTo($request): ?string
    {
        if ($this->shouldReturnJson($request)) {
            return null;
        }

        return route('login');
    }

    private function shouldReturnJson(Request $request): bool
    {
        return $request->expectsJson() || $request->is('api/*');
    }
}
