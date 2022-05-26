<?php

declare(strict_types=1);

namespace App\Repositories\Directory\Relation;

use App\Models\Directory\Relation;
use Illuminate\Support\Collection;
use App\Dto\Entities\Directory\RelationDto;

final class PgSqlRelationRepository implements RelationRepositoryInterface
{
    private Relation $model;

    public function __construct(Relation $model)
    {
        $this->model = $model;
    }

    public function create(RelationDto $dto): RelationDto
    {
        $object = $this->model
            ->newQuery()
            ->create($dto->toArray());

        return RelationDto::fromArray($object->toArray());
    }

    public function update(array $filters, array $data): void
    {
        $this->model
            ->newQuery()
            ->where($filters)
            ->update($data);
    }

    public function get(array $filters): ?RelationDto
    {
        $object = $this->model
            ->newQuery()
            ->where($filters)
            ->first();

        return $object ? RelationDto::fromArray($object->toArray()) : null;
    }

    public function list(array $filters, callable $callback = null): ?Collection
    {
        return $this->model
            ->newQuery()
            ->where($filters)
            ->where($callback)
            ->get()?->map(function (Relation $row) {
                return RelationDto::fromArray($row->toArray());
            });
    }

    public function delete(array $filters): void
    {
        $this->model
            ->newQuery()
            ->where($filters)
            ->delete();
    }
}
