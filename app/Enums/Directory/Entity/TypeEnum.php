<?php

declare(strict_types=1);

namespace App\Enums\Directory\Entity;

final class TypeEnum
{
    public const SCHEMA = 'schema';

    public const TABLE = 'table';

    public const LIST = [
        self::SCHEMA,
        self::TABLE,
    ];
}
