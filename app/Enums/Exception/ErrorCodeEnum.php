<?php

declare(strict_types=1);

namespace App\Enums\Exception;

final class ErrorCodeEnum
{
    public const ERR_0 = '000'; //Unprocessable error.
    public const ERR_1 = '001'; //Too many requests in time moment.
    public const ERR_2 = '002'; //Invalid or expired token.
    public const ERR_3 = '003'; //Access denied.
    public const ERR_4 = '004'; //The table must have a parent node.
    public const ERR_5 = '005'; //Wrong parent link type.
    public const ERR_6 = '006'; //Forbidden access.
}
