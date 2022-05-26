<?php

declare(strict_types=1);

namespace App\Pipelines\V1\Private\Directory\Entity;

use App\Pipelines\AbstractPipeline;
use App\Dto\Pipelines\Directory\EntityPipelineDto;
use App\Pipelines\V1\Private\Directory\Entity\Pipes\Create\ColumnPipe as CreateColumnPipe;
use App\Pipelines\V1\Private\Directory\Entity\Pipes\Create\EntityPipe as CreateEntityPipe;
use App\Pipelines\V1\Private\Directory\Entity\Pipes\Create\SchemaPipe as CreateSchemaPipe;
use App\Pipelines\V1\Private\Directory\Entity\Pipes\Delete\EntityPipe as DeleteEntityPipe;
use App\Pipelines\V1\Private\Directory\Entity\Pipes\Delete\SchemaPipe as DeleteSchemaPipe;
use App\Pipelines\V1\Private\Directory\Entity\Pipes\Delete\ColumnPipe as DeleteColumnPipe;
use App\Pipelines\V1\Private\Directory\Entity\Pipes\Delete\RelationPipe as DeleteRelationPipe;
use App\Pipelines\V1\Private\Directory\Entity\Pipes\Create\RelationPipe as CreateRelationPipe;

final class EntityPipeline extends AbstractPipeline
{
    public function create(EntityPipelineDto $dto): array
    {
        return $this->pipeline([
            CreateEntityPipe::class,
            CreateColumnPipe::class,
            CreateRelationPipe::class,
            CreateSchemaPipe::class,
        ], $dto);
    }

    public function delete(EntityPipelineDto $dto): array
    {
        return $this->pipeline([
            DeleteEntityPipe::class,
            DeleteColumnPipe::class,
            DeleteRelationPipe::class,
            DeleteSchemaPipe::class,
        ], $dto);
    }
}
