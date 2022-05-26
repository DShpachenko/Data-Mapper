<?php

declare(strict_types=1);

namespace App\Exceptions\System;

use Throwable;
use RuntimeException;
use App\Enums\Exception\ErrorCodeEnum;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\ApplicationExceptionInterface;

final class TooManyRequestsException extends RuntimeException implements ApplicationExceptionInterface
{
    public function __construct(
        string    $message = '',
        int       $code = Response::HTTP_TOO_MANY_REQUESTS,
        Throwable $previous = null)
    {
        $message = empty($message) ? trans('exceptions.m1') : $message;

        parent::__construct($message, $code, $previous);
    }

    public function getErrorCode(): string
    {
        return ErrorCodeEnum::ERR_1;
    }
}
