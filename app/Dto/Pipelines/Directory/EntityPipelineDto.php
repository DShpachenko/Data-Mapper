<?php

declare(strict_types=1);

namespace App\Dto\Pipelines\Directory;

use App\Dto\DtoInterface;
use App\Dto\Entities\Directory\EntityDto;

final class EntityPipelineDto implements DtoInterface
{
    private EntityDto|null $entity;

    private array|null $columns;

    private array|null $relations;

    public function __construct(
        ?EntityDto $entity,
        ?array $columns,
        ?array $relations
    )
    {
        $this->entity = $entity;
        $this->columns = $columns;
        $this->relations = $relations;
    }

    public function toArray(): array
    {
        return [
            'entity' => $this->entity,
            'columns' => $this->columns,
            'relations' => $this->relations,
        ];
    }

    public static function fromArray(array $arguments): DtoInterface|EntityPipelineDto
    {
        return new self(
            $arguments['entity'] ?? null,
            $arguments['columns'] ?? null,
            $arguments['relations'] ?? null
        );
    }

    public function getEntity(): ?EntityDto
    {
        return $this->entity;
    }

    public function setEntity(EntityDto $entity): void
    {
        $this->entity = $entity;
    }

    public function getColumns(): ?array
    {
        return $this->columns;
    }

    public function setColumns(array $columns): void
    {
        $this->columns = $columns;
    }

    public function getRelations(): ?array
    {
        return $this->relations;
    }

    public function setRelations(array $relations): void
    {
        $this->relations = $relations;
    }
}
