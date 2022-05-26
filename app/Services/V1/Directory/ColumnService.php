<?php

declare(strict_types=1);

namespace App\Services\V1\Directory;

use Illuminate\Support\Collection;
use App\Dto\Entities\Directory\ColumnDto;
use App\Repositories\Directory\Column\ColumnRepositoryInterface;

final class ColumnService
{
    private ColumnRepositoryInterface $repository;

    public function __construct(ColumnRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(ColumnDto $dto): ColumnDto
    {
        return $this->repository->create($dto);
    }

    public function get(array $filters): ?ColumnDto
    {
        return $this->repository->get($filters);
    }

    public function list(array $filters, callable $callback = null): ?Collection
    {
        return $this->repository->list($filters, $callback);
    }

    public function update(array $filters, array $data): void
    {
        $this->repository->update($filters, $data);
    }

    public function delete(array $filters): void
    {
        $this->repository->delete($filters);
    }
}
