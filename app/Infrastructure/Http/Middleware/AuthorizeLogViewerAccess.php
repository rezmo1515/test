<?php

namespace App\Infrastructure\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizeLogViewerAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('sanctum')->user();

        if (! $user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized.'
            ], 401);
        }

        if (! $user->hasPermission('log:show')) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission.'
            ], 403);
        }

        return $next($request);
    }
}

