<?php

declare(strict_types=1);

namespace App\Pipelines\V1\Private\Directory\Entity\Pipes\Delete;

use Closure;
use App\Dto\DtoInterface;
use App\Pipelines\PipeInterface;
use App\Dto\Entities\Directory\ColumnDto;
use App\Services\V1\Directory\RelationService;
use App\Dto\Pipelines\Directory\EntityPipelineDto;

final class RelationPipe implements PipeInterface
{
    private RelationService $service;

    public function __construct(RelationService $service)
    {
        $this->service = $service;
    }

    public function handle(DtoInterface|EntityPipelineDto $dto, Closure $next): DtoInterface
    {
        $columns = $dto->getColumns() ?? [];
        $relations = [];

        /** @var ColumnDto $column */
        foreach ($columns as $column) {
            $relations[] = $this->service->get(['from_column_id' => $column->getId()]);
        }

        $dto->setRelations($relations);

        return $next($dto);
    }
}
