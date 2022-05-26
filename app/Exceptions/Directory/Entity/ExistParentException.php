<?php

declare(strict_types=1);

namespace App\Exceptions\Directory\Entity;

use Throwable;
use RuntimeException;
use App\Enums\Exception\ErrorCodeEnum;
use Symfony\Component\HttpFoundation\Response;
use SecretCompanyName\LaravelAuthId\Exceptions\ApplicationExceptionInterface;

use function trans;

final class ExistParentException extends RuntimeException implements ApplicationExceptionInterface
{
    public function __construct(string $message = '', int $code = Response::HTTP_NOT_FOUND, Throwable $previous = null)
    {
        $message = empty($message) ? trans('exceptions.m4') : $message;

        parent::__construct($message, $code, $previous);
    }

    public function getErrorCode(): string
    {
        return ErrorCodeEnum::ERR_4;
    }
}
