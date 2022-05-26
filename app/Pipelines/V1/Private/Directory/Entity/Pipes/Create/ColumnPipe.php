<?php

declare(strict_types=1);

namespace App\Pipelines\V1\Private\Directory\Entity\Pipes\Create;

use Closure;
use App\Dto\DtoInterface;
use App\Pipelines\PipeInterface;
use App\Dto\Entities\Directory\EntityDto;
use App\Dto\Entities\Directory\ColumnDto;
use App\Services\V1\Directory\ColumnService;
use App\Dto\Pipelines\Directory\EntityPipelineDto;
use App\Enums\Directory\Column\TypeEnum as ColumnTypeEnum;
use App\Enums\Directory\Entity\TypeEnum as EntityTypeEnum;
use App\Exceptions\Directory\Column\WrongRelationTypeException;

final class ColumnPipe implements PipeInterface
{
    private ColumnService $service;

    public function __construct(ColumnService $service)
    {
        $this->service = $service;
    }

    public function handle(DtoInterface|EntityPipelineDto $dto, Closure $next): DtoInterface
    {
        $columns = $dto->getColumns();
        $entity = $dto->getEntity();

        if ($entity->getType() === EntityTypeEnum::TABLE) {
            $columns = $this->makeBaseRelation($entity, $columns);
            $columns = $this->makeBaseColumns($entity, $columns);

            $newColumns = [];

            foreach ($columns as $column) {
                $column = $this->checkRelationType($column);
                $column->setEntityId($dto->getEntity()->getId());

                $newColumn = $this->service->create($column);
                $newColumn->setRelationObject($column->getRelationObject());
                $newColumns[] = $newColumn;
            }

            $dto->setColumns($newColumns);
        }

        return $next($dto);
    }

    private function checkRelationType(ColumnDto $dto): ColumnDto
    {
        if ($relationId = $dto->getRelationId()) {
            $column = $this->service->get(['id' => $relationId]);

            if (!in_array($column->getType(), [$dto->getType(), ColumnTypeEnum::ID])) {
                throw new WrongRelationTypeException();
            }

            $dto->setRelationObject($column);
        }

        return $dto;
    }

    private function makeBaseColumns(EntityDto $dto, array $columns): array
    {
        return array_merge([
            ColumnDto::fromArray([
                'name' => 'ID',
                'symbol' => 'id',
                'type' => ColumnTypeEnum::ID,
            ]),
        ], $columns, [
            ColumnDto::fromArray([
                'name' => 'Дата создания',
                'symbol' => 'created_at',
                'type' => ColumnTypeEnum::TIMESTAMPS,
            ]),
            ColumnDto::fromArray([
                'name' => 'Дата обновления',
                'symbol' => 'updated_at',
                'type' => ColumnTypeEnum::TIMESTAMPS,
            ]),
        ]);
    }

    private function makeBaseRelation(EntityDto $dto, array $columns): array
    {
        $parent = $dto->getParentObject();
        if ($parent && $parent->getType() === EntityTypeEnum::TABLE) {
            $column = $this->service->get([
                'entity_id' => $parent->getId(),
                'symbol' => 'id',
            ]);

            $columns = array_merge([
                ColumnDto::fromArray([
                    'name' => 'Связь с ' . $parent->getName(),
                    'symbol' => $parent->getSymbol() . '_' . 'id',
                    'type' => ColumnTypeEnum::BIGINT,
                    'relation_id' => $column->getId(),
                ]),
            ], $columns);
        }

        return $columns;
    }
}
