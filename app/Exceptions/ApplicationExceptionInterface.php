<?php

declare(strict_types=1);

namespace App\Exceptions;

interface ApplicationExceptionInterface
{
    public function getErrorCode(): string;
}
