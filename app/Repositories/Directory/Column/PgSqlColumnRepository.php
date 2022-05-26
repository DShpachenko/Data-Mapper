<?php

declare(strict_types=1);

namespace App\Repositories\Directory\Column;

use App\Models\Directory\Column;
use Illuminate\Support\Collection;
use App\Dto\Entities\Directory\ColumnDto;

final class PgSqlColumnRepository implements ColumnRepositoryInterface
{
    private Column $model;

    public function __construct(Column $model)
    {
        $this->model = $model;
    }

    public function create(ColumnDto $dto): ColumnDto
    {
        $object = $this->model
            ->newQuery()
            ->create($dto->toArray());

        return ColumnDto::fromArray($object->toArray());
    }

    public function update(array $filters, array $data): void
    {
        $this->model
            ->newQuery()
            ->where($filters)
            ->update($data);
    }

    public function get(array $filters): ?ColumnDto
    {
        $object = $this->model
            ->newQuery()
            ->where($filters)
            ->first();

        return $object ? ColumnDto::fromArray($object->toArray()) : null;
    }

    public function list(array $filters, callable $callback = null): ?Collection
    {
        return $this->model
            ->newQuery()
            ->where($filters)
            ->where($callback)
            ->orderBy('id')
            ->get()?->map(function (Column $row) {
                return ColumnDto::fromArray($row->toArray());
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
