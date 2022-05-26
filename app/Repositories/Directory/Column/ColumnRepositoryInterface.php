<?php

declare(strict_types=1);

namespace App\Repositories\Directory\Column;

use Illuminate\Support\Collection;
use App\Dto\Entities\Directory\ColumnDto;

interface ColumnRepositoryInterface
{
    public function create(ColumnDto $dto): ColumnDto;

    public function get(array $filters): ?ColumnDto;

    public function list(array $filters, callable $callback = null): ?Collection;

    public function update(array $filters, array $data): void;

    public function delete(array $filters): void;
}
