<?php

declare(strict_types=1);

namespace App\Repositories\Abstract;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class PgSqlAbstractRepository implements AbstractRepositoryInterface
{

    public function create(string $schema, string $symbol, array $columns): ?array
    {
        $id = DB::table($schema . '.' . $symbol)
            ->insertGetId(array_merge($columns, [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]));

        return $this->get($schema, $symbol, ['id' => $id]);
    }

    public function get(string $schema, string $symbol, array $filters): ?array
    {
        $row = DB::table($schema . '.' . $symbol)
                ->where($filters)
                ->first();

        return $row ? (array)$row : null;
    }

    public function list(string $schema, string $symbol, array $filters, callable $callback = null): ?Collection
    {
        return DB::table($schema . '.' . $symbol)
            ->where($filters)
            ->where($callback)
            ->orderBy('id')
            ->get();
    }

    public function update(string $schema, string $symbol, array $filters, array $data): void
    {
        DB::table($schema . '.' . $symbol)
            ->where($filters)
            ->update($data);
    }

    public function delete(string $schema, string $symbol, array $filters): void
    {
        DB::table($schema . '.' . $symbol)
            ->where($filters)
            ->delete();
    }
}
