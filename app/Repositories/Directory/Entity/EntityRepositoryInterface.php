<?php

declare(strict_types=1);

namespace App\Repositories\Directory\Entity;

use Illuminate\Support\Collection;
use App\Dto\Entities\Directory\EntityDto;

interface EntityRepositoryInterface
{
    public function create(EntityDto $dto): EntityDto;

    public function get(array $filters): ?EntityDto;

    public function list(array $filters, callable $callback = null): ?Collection;

    public function update(array $filters, array $data): void;

    public function delete(array $filters): void;
}
