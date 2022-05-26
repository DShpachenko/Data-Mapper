<?php

declare(strict_types=1);

namespace App\Services\V1\Directory;

use Illuminate\Support\Collection;
use App\Dto\Entities\Directory\EntityDto;
use App\Repositories\Directory\Entity\EntityRepositoryInterface;

final class EntityService
{
    private EntityRepositoryInterface $repository;

    public function __construct(EntityRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(EntityDto $dto): EntityDto
    {
        return $this->repository->create($dto);
    }

    public function get(array $filters): ?EntityDto
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
