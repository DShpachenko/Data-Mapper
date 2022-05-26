<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Private\Directory;

use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller;
use App\Dto\Entities\Directory\EntityDto;
use App\Services\V1\Directory\EntityService;
use Symfony\Component\HttpFoundation\Response;
use App\Dto\Pipelines\Directory\EntityPipelineDto;
use App\Pipelines\V1\Private\Directory\Entity\EntityPipeline;
use App\Http\Requests\V1\Private\Directory\Entity\DeleteRequest;
use App\Http\Requests\V1\Private\Directory\Entity\CreateRequest;
use App\Http\Requests\V1\Private\Directory\Entity\ChangeVisibilityRequest;

final class EntityController extends Controller
{
    private EntityPipeline $pipeline;

    private EntityService $service;

    public function __construct(EntityPipeline $pipeline, EntityService $service)
    {
        $this->service = $service;
        $this->pipeline = $pipeline;
    }

    public function create(CreateRequest $request): JsonResponse
    {
        /** @var EntityPipelineDto $dto */
        [$dto, $e] = $this->pipeline->create($request->dto());

        if (!$e) {
            return response()->json(['data' => $dto->getEntity()->toArray()], Response::HTTP_CREATED);
        }

        return response()->__call('pipeline_exception', [$e]);
    }

    public function all(): JsonResponse
    {
        return response()->json([
            'data' => $this->service->list([])?->map(function (EntityDto $dto) {
                return $dto->toArray();
            }),
        ]);
    }

    public function changeVisibility(ChangeVisibilityRequest $request): JsonResponse
    {
        $dto = $request->dto();
        $this->service->update(['id' => $dto->getId()], ['visibility' => $dto->getVisibility()]);

        return response()->json();
    }

    public function delete(DeleteRequest $request): JsonResponse
    {
        [$dto, $e] = $this->pipeline->delete($request->dto());

        if (!$e) {
            return response()->json();
        }

        return response()->__call('pipeline_exception', [$e]);
    }
}
