<?php

declare(strict_types=1);

namespace App\Pipelines\V1\Private\Directory\Entity\Pipes\Delete;

use Closure;
use App\Dto\DtoInterface;
use App\Pipelines\PipeInterface;
use App\Enums\Directory\Entity\TypeEnum;
use App\Dto\Entities\Directory\ColumnDto;
use App\Services\V1\Schema\SchemaService;
use App\Dto\Entities\Directory\RelationDto;
use App\Services\V1\Directory\EntityService;
use App\Dto\Pipelines\Directory\EntityPipelineDto;

final class SchemaPipe implements PipeInterface
{
    private SchemaService $service;

    private EntityService $entityService;

    public function __construct(
        SchemaService $service,
        EntityService $entityService
    )
    {
        $this->service = $service;
        $this->entityService = $entityService;
    }

    public function handle(DtoInterface|EntityPipelineDto $dto, Closure $next): DtoInterface
    {
        $entity = $dto->getEntity();

        if ($entity->getType() === TypeEnum::TABLE) {
            $relations = $dto->getRelations();
            /** @var RelationDto $relation */
            foreach ($relations as $relation) {
                $this->deleteForeign($relation);
            }

            $columns = $dto->getColumns();
            /** @var ColumnDto $column */
            foreach ($columns as $column) {
                $this->deleteColumn($column);
            }

            $this->service->deleteTable($entity->getSymbol(), $entity->getSchema());
            $this->entityService->delete(['id' => $entity->getId()]);
        } else if ($entity->getType() === TypeEnum::SCHEMA) {
            $this->service->deleteSchema($entity->getSchema());
        }

        return $next($dto);
    }

    private function deleteForeign(RelationDto $relation): void
    {
        $entity = $this->entityService->get(['id' => $relation->getFromEntityId()]);
        $this->service->deleteForeign($entity->getSymbol(), $entity->getSchema(), $relation->getForeign());
    }

    private function deleteColumn(ColumnDto $column): void
    {
        $entity = $this->entityService->get(['id' => $column->getEntityId()]);
        $this->service->deleteColumn($entity->getSymbol(), $entity->getSchema(), $column->getSymbol());
    }
}
