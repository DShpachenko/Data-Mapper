<?php

declare(strict_types=1);

namespace App\Services\V1\Abstract;

use Illuminate\Support\Collection;
use App\Repositories\Abstract\AbstractRepositoryInterface;

final class AbstractService
{
    private AbstractRepositoryInterface $repository;

    public function __construct(AbstractRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(string $schema, string $symbol, array $columns): ?array
    {
        return $this->repository->create($schema, $symbol, $columns);
    }

    public function get(string $schema, string $symbol, array $filters): ?array
    {
        return $this->repository->get($schema, $symbol, $filters);
    }

    public function list(string $schema, string $symbol, array $filters = [], callable $callback = null): ?Collection
    {
        return $this->repository->list($schema, $symbol, $filters, $callback);
    }

    public function update(string $schema, string $symbol, array $filters, array $data): void
    {
        $this->repository->update($schema, $symbol, $filters, $data);
    }

    public function delete(string $schema, string $symbol, array $filters): void
    {
        $this->repository->delete($schema, $symbol, $filters);
    }
}
