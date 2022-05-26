<?php

declare(strict_types=1);

namespace App\Providers;

use Throwable;
use App\Helpers\HttpStatusCodeHelper;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Http\ResponseFactory;

final class ResponseMacroServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        ResponseFactory::macro('pipeline_exception', function (Throwable $e) {
            return response()->json([
                'errors' => [
                    'pipeline_exception' => [
                        'error_code' => HttpStatusCodeHelper::getExceptionErrorCode($e),
                        'status' => HttpStatusCodeHelper::getStatusCode((int)$e->getCode()),
                        'message' => $e->getMessage(),
                    ],
                ],
            ], HttpStatusCodeHelper::getStatusCode((int)$e->getCode()));
        });

        ResponseFactory::macro('validation', function (array $errors, int $code) {
            return response()->json([
                'errors' => [
                    'validation' => $errors,
                ],
            ], $code);
        });
    }
}
