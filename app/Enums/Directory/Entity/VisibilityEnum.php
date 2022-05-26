<?php

declare(strict_types=1);

namespace App\Enums\Directory\Entity;

final class VisibilityEnum
{
    public const PUBLIC = 'public';

    public const PRIVATE = 'private';

    public const LIST = [
        self::PUBLIC,
        self::PRIVATE,
    ];
}
