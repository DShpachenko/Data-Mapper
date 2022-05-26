<?php

declare(strict_types=1);

namespace App\Enums\Directory\Column;

final class TypeEnum
{
    public const ID = 'id';

    public const BIGINT = 'bigint';

    public const VARCHAR = 'varchar';

    public const TIMESTAMPS = 'timestamps';

    public const LIST = [
        self::ID,
        self::BIGINT,
        self::VARCHAR,
        self::TIMESTAMPS,
    ];

    public const PUBLIC_LIST = [
        self::BIGINT,
        self::VARCHAR,
    ];
}
