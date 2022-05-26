<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

final class CorsMiddleware
{
    private const HEADERS = [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'POST, PATCH, GET, OPTIONS, PUT, DELETE',
        'Access-Control-Allow-Credentials' => 'true',
        'Access-Control-Max-Age' => '86400',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Requested-With',
    ];

    public function handle(Request $request, Closure $next): Closure|Response|JsonResponse
    {
        if ($request->isMethod('OPTIONS')) {
            return response()->json('{"method":"OPTIONS"}', 200, self::HEADERS);
        }

        $response = $next($request);

        foreach (self::HEADERS as $key => $value) {
            $response->header($key, $value);
        }

        return $response;
    }
}
