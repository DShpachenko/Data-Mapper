<?php

declare(strict_types=1);

namespace App\Repositories\Schema;

interface SchemaRepositoryInterface
{
    public function createSchema(string $schemaName): void;

    public function createTable(string $tableName, string $schemaName, array $columns, array $relations): void;

    public function deleteSchema(string $schemaName): void;

    public function deleteTable(string $tableName, string $schemaName): void;

    public function deleteForeign(string $tableName, string $schemaName, string $foreign): void;

    public function deleteColumn(string $tableName, string $schemaName, string $column): void;
}
