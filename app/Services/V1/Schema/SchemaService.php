<?php

declare(strict_types=1);

namespace App\Services\V1\Schema;

use App\Repositories\Schema\SchemaRepositoryInterface;

final class SchemaService
{
    private SchemaRepositoryInterface $repository;

    public function __construct(SchemaRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function createSchema(string $schemaName): void
    {
        $this->repository->createSchema($schemaName);
    }

    public function createTable(string $tableName, string $schemaName, array $columns, ?array $relations): void
    {
        $this->repository->createTable($tableName, $schemaName, $columns, $relations ?? []);
    }

    public function deleteTable(string $tableName, string $schemaName): void
    {
        $this->repository->deleteTable($tableName, $schemaName);
    }

    public function deleteSchema(string $schemaName): void
    {
        $this->repository->deleteSchema($schemaName);
    }

    public function deleteForeign(string $tableName, string $schemaName, string $foreign): void
    {
        $this->repository->deleteForeign($tableName, $schemaName, $foreign);
    }

    public function deleteColumn(string $tableName, string $schemaName, string $column): void
    {
        $this->repository->deleteColumn($tableName, $schemaName, $column);
    }
}
