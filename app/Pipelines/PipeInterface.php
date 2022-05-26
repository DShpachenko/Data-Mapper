<?php

declare(strict_types=1);

namespace App\Pipelines;

use Closure;
use App\Dto\DtoInterface;

interface PipeInterface
{
    public function handle(DtoInterface $dto, Closure $next): DtoInterface;
}
