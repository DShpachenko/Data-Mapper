<?php

declare(strict_types=1);

namespace App\Pipelines\V1\Private\Directory\Entity\Pipes\Create;

use Closure;
use App\Dto\DtoInterface;
use App\Pipelines\PipeInterface;
use App\Enums\Directory\Entity\TypeEnum;
use App\Dto\Entities\Directory\EntityDto;
use App\Services\V1\Directory\EntityService;
use App\Dto\Pipelines\Directory\EntityPipelineDto;
use App\Exceptions\Directory\Entity\ExistParentException;

final class EntityPipe implements PipeInterface
{
    private EntityService $service;

    public function __construct(EntityService $service)
    {
        $this->service = $service;
    }

    public function handle(DtoInterface|EntityPipelineDto $dto, Closure $next): DtoInterface
    {
        $entity = $dto->getEntity();
        $this->checkParentId($entity);
        $entity = $this->setSchemaId($entity);
        $newEntity = $this->service->create($entity);
        $newEntity->setParentObject($entity->getParentObject());
        $newEntity->setSchema($entity->getSchema());
        $dto->setEntity($newEntity);

        return $next($dto);
    }

    private function checkParentId(EntityDto $dto): void
    {
        if ($dto->getType() === TypeEnum::TABLE && !$dto->getParentId()) {
            throw new ExistParentException();
        }
    }

    private function setSchemaId(EntityDto $dto): EntityDto
    {
        if ($parentId = $dto->getParentId()) {
            $entity = $this->service->get(['id' => $parentId]);
            $dto->setParentObject($entity);

            $dto->setSchema(
                $entity->getType() === TypeEnum::SCHEMA ? $entity->getSymbol() : $entity->getSchema()
            );
        }

        return $dto;
    }
}
