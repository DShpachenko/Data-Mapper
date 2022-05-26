<?php

declare(strict_types=1);

namespace App\Helpers;

use Throwable;
use App\Enums\Exception\ErrorCodeEnum;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\ApplicationExceptionInterface;

final class HttpStatusCodeHelper
{
    public static function getStatusCode(int $code): int
    {
        return self::isInvalid($code) ? Response::HTTP_UNPROCESSABLE_ENTITY : $code;
    }

    public static function isInvalid(int $code): bool
    {
        return $code < 100 || $code >= 600;
    }

    public static function getExceptionErrorCode(ApplicationExceptionInterface|Throwable $e): string
    {
        return env('APP_NAME') . ':' . (method_exists($e, 'getErrorCode') ?
                $e->getErrorCode() :
                ErrorCodeEnum::ERR_0);
    }
}
