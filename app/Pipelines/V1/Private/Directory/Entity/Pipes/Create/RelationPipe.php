<?php

declare(strict_types=1);

namespace App\Pipelines\V1\Private\Directory\Entity\Pipes\Create;

use App\Services\V1\Directory\ColumnService;
use Closure;
use App\Dto\DtoInterface;
use App\Pipelines\PipeInterface;
use App\Enums\Directory\Entity\TypeEnum;
use App\Dto\Entities\Directory\ColumnDto;
use App\Dto\Entities\Directory\RelationDto;
use App\Services\V1\Directory\EntityService;
use App\Services\V1\Directory\RelationService;
use App\Dto\Pipelines\Directory\EntityPipelineDto;

final class RelationPipe implements PipeInterface
{
    private RelationService $service;

    private EntityService $entityService;

    private ColumnService $columnService;

    public function __construct(RelationService $service, EntityService $entityService, ColumnService $columnService)
    {
        $this->service = $service;
        $this->entityService = $entityService;
        $this->columnService = $columnService;
    }

    public function handle(DtoInterface|EntityPipelineDto $dto, Closure $next): DtoInterface
    {
        $entity = $dto->getEntity();

        if ($entity->getType() === TypeEnum::TABLE) {
            $columns = $dto->getColumns();

            $relations = [];

            /** @var ColumnDto $column */
            foreach ($columns as $column) {
                if ($column->getRelationId()) {
                    $relatedEntity = $this->entityService->get(['id' => $column->getRelationObject()->getEntityId()]);
                    $relatedColumn = $this->columnService->get([
                        'entity_id' => $column->getRelationObject()->getEntityId(),
                        'symbol' => 'id',
                    ]);

                    $relations[] = $this->service->create(RelationDto::fromArray([
                        'from_entity_id' => $entity->getId(),
                        'to_entity_id' => $relatedEntity->getId(),
                        'from_column_id' => $column->getId(),
                        'to_column_id' => $relatedColumn->getId(),
                        'foreign' => $column->getSymbol(),
                        'references' => 'id',
                        'table' => $relatedEntity->getSchema() . '.' . $relatedEntity->getSymbol(),
                    ]));
                }
            }

            $dto->setRelations($relations);
        }

        return $next($dto);
    }
}
