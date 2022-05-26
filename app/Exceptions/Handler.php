<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class Handler extends ExceptionHandler
{
    /**
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    public function render($request, Throwable $e): Response|JsonResponse
    {
        if ($e instanceof ValidationException) {
            return $e->getResponse();
        }

        return response()->__call('pipeline_exception', [$e]);
    }
}
