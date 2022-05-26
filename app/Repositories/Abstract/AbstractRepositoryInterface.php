<?php

declare(strict_types=1);

namespace App\Repositories\Abstract;

use Illuminate\Support\Collection;

interface AbstractRepositoryInterface
{
    public function create(string $schema, string $symbol, array $columns): ?array;

    public function get(string $schema, string $symbol, array $filters): ?array;

    public function list(string $schema, string $symbol, array $filters, callable $callback = null): ?Collection;

    public function update(string $schema, string $symbol, array $filters, array $data): void;

    public function delete(string $schema, string $symbol, array $filters): void;
}
