<?php

declare(strict_types=1);

namespace App\Dto;

interface DtoInterface
{
    public function toArray(): array;

    public static function fromArray(array $arguments): DtoInterface;
}
