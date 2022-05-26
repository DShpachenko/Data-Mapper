<?php

declare(strict_types=1);

namespace App\Pipelines\V1\Private\Directory\Entity\Pipes\Delete;

use Closure;
use App\Dto\DtoInterface;
use App\Pipelines\PipeInterface;
use App\Services\V1\Directory\EntityService;
use App\Dto\Pipelines\Directory\EntityPipelineDto;

final class EntityPipe implements PipeInterface
{
    private EntityService $service;

    public function __construct(EntityService $service)
    {
        $this->service = $service;
    }

    public function handle(DtoInterface|EntityPipelineDto $dto, Closure $next): DtoInterface
    {
        $dto->setEntity($this->service->get(['id' => $dto->getEntity()->getId()]));

        return $next($dto);
    }
}
