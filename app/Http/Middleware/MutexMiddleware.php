<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Services\V1\System\RedisClient;
use App\Exceptions\System\TooManyRequestsException;

final class MutexMiddleware
{
    private RedisClient $redis;

    public function __construct(RedisClient $redis)
    {
        $this->redis = $redis;
    }

    public function handle(Request $request, Closure $next): Closure|Response|JsonResponse
    {
        $hash = serialize([
            $request->method(),
            $request->ip(),
            $request->path(),
            $request->all(),
        ]);

        if (!$this->redis->lock(env('MUTEX_CHANNEL'), $hash)) {
            return response()->__call('pipeline_exception', [new TooManyRequestsException()]);
        }

        return $next($request);
    }
}
