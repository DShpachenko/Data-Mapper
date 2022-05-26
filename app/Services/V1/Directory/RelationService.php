<?php

declare(strict_types=1);

namespace App\Services\V1\Directory;

use Illuminate\Support\Collection;
use App\Dto\Entities\Directory\RelationDto;
use App\Repositories\Directory\Relation\RelationRepositoryInterface;

final class RelationService
{
    private RelationRepositoryInterface $repository;

    public function __construct(RelationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(RelationDto $dto): RelationDto
    {
        return $this->repository->create($dto);
    }

    public function get(array $filters): ?RelationDto
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
