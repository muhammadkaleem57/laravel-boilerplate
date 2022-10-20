<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyApiRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->expectsJson()) {
            return response()->json([
                'code' => HTTP_BAD_REQUEST,
                'message' => 'Accept only application/json'
            ], HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}
