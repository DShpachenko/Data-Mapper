<?php

declare(strict_types=1);

namespace App\Repositories\Directory\Entity;

use App\Models\Directory\Entity;
use Illuminate\Support\Collection;
use App\Dto\Entities\Directory\EntityDto;

final class PgSqlEntityRepository implements EntityRepositoryInterface
{
    private Entity $model;

    public function __construct(Entity $model)
    {
        $this->model = $model;
    }

    public function create(EntityDto $dto): EntityDto
    {
        $object = $this->model
            ->newQuery()
            ->create(array_filter($dto->toArray()));

        return EntityDto::fromArray($object->toArray());
    }

    public function update(array $filters, array $data): void
    {
        $this->model
            ->newQuery()
            ->where($filters)
            ->update($data);
    }

    public function get(array $filters): ?EntityDto
    {
        $object = $this->model
            ->newQuery()
            ->where($filters)
            ->first();

        return $object ? EntityDto::fromArray($object->toArray()) : null;
    }

    public function list(array $filters, callable $callback = null): ?Collection
    {
        $query = $this->model
            ->newQuery()
            ->where($filters);

        if ($callback) {
            $query->where($callback);
        }

        return $query->orderBy('id')
            ->get()?->map(function (Entity $row) {
            return EntityDto::fromArray($row->toArray());
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
