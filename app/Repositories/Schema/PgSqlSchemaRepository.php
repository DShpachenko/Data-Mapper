<?php

declare(strict_types=1);

namespace App\Repositories\Schema;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Enums\Directory\Column\TypeEnum;
use App\Dto\Entities\Directory\ColumnDto;
use Illuminate\Database\Schema\Blueprint;
use App\Dto\Entities\Directory\RelationDto;

final class PgSqlSchemaRepository implements SchemaRepositoryInterface
{
    private const DEFAULT_VARCHAR_LENGTH = 200;

    public function createSchema(string $schemaName): void
    {
        DB::select('CREATE SCHEMA ' . $schemaName);
    }

    public function createTable(string $tableName, string $schemaName, array $columns, array $relations = []): void
    {
        Schema::create($schemaName . '.' . $tableName, function (Blueprint $table) use ($columns, $relations) {
            $table->id();

            /** @var ColumnDto $column */
            foreach ($columns as $column) {
                if ($column->getType() === TypeEnum::VARCHAR) {
                    $table->string($column->getSymbol(), self::DEFAULT_VARCHAR_LENGTH)
                        ->comment($column->getName());
                }

                if ($column->getType() === TypeEnum::BIGINT) {
                    $table->bigInteger($column->getSymbol())->comment($column->getName());
                }
            }

            $table->timestamps();

            /** @var RelationDto $relation */
            foreach ($relations as $relation) {
                $table->foreign($relation->getForeign())
                    ->references($relation->getReferences())
                    ->on($relation->getTable());
            }
        });
    }

    public function deleteSchema(string $schemaName): void
    {
        DB::select('DROP SCHEMA ' . $schemaName . ' CASCADE');
    }

    public function deleteTable(string $tableName, string $schemaName): void
    {
        DB::select('DROP TABLE ' . $schemaName . '.' . $tableName . ' CASCADE');
    }

    public function deleteForeign(string $tableName, string $schemaName, string $foreign): void
    {
        Schema::table($schemaName . '.' . $tableName, function (Blueprint $table) use ($foreign) {
            $table->dropConstrainedForeignId($foreign);
        });
    }

    public function deleteColumn(string $tableName, string $schemaName, string $column): void
    {
        DB::select('ALTER TABLE ' . $schemaName . '.' . $tableName . ' DROP IF EXISTS ' . $column);
    }
}
