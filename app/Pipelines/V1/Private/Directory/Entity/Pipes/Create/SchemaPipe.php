<?php

declare(strict_types=1);

namespace App\Pipelines\V1\Private\Directory\Entity\Pipes\Create;

use Closure;
use App\Dto\DtoInterface;
use App\Pipelines\PipeInterface;
use App\Enums\Directory\Entity\TypeEnum;
use App\Services\V1\Schema\SchemaService;
use App\Dto\Pipelines\Directory\EntityPipelineDto;

final class SchemaPipe implements PipeInterface
{
    private SchemaService $service;

    public function __construct(SchemaService $service)
    {
        $this->service = $service;
    }

    public function handle(DtoInterface|EntityPipelineDto $dto, Closure $next): DtoInterface
    {
        $entity = $dto->getEntity();

        if ($entity->getType() === TypeEnum::SCHEMA) {
            $this->service->createSchema($entity->getSymbol());
        } else if ($entity->getType() === TypeEnum::TABLE) {
            $this->service->createTable(
                $entity->getSymbol(),
                $entity->getSchema(),
                $dto->getColumns(),
                $dto->getRelations()
            );
        }

        return $next($dto);
    }
}
