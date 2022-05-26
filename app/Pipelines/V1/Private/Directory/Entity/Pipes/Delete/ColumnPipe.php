<?php

declare(strict_types=1);

namespace App\Pipelines\V1\Private\Directory\Entity\Pipes\Delete;

use Closure;
use App\Dto\DtoInterface;
use App\Pipelines\PipeInterface;
use App\Dto\Entities\Directory\ColumnDto;
use App\Services\V1\Directory\ColumnService;
use App\Dto\Pipelines\Directory\EntityPipelineDto;
use App\Enums\Directory\Entity\TypeEnum as EntityTypeEnum;

final class ColumnPipe implements PipeInterface
{
    private ColumnService $service;

    public function __construct(ColumnService $service)
    {
        $this->service = $service;
    }

    public function handle(DtoInterface|EntityPipelineDto $dto, Closure $next): DtoInterface
    {
        $entity = $dto->getEntity();

        if ($entity->getType() === EntityTypeEnum::TABLE) {
            $columns = $this->service->list(['entity_id' => $entity->getId()]);

            $dto->setColumns($this->service->list([], function ($query) use ($columns) {
                return $query->whereIn('relation_id', $columns?->map(function (ColumnDto $column) {
                    return $column->getId();
                })?->toArray());
            })?->toArray());
        }

        return $next($dto);
    }
}
