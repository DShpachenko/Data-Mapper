<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Public\Directory;

use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller;
use App\Dto\Entities\Directory\EntityDto;
use App\Services\V1\Directory\EntityService;
use App\Enums\Directory\Entity\VisibilityEnum;

final class EntityController extends Controller
{
    private EntityService $service;

    public function __construct(EntityService $service)
    {
        $this->service = $service;
    }

    public function all(): JsonResponse
    {
        return response()->json([
            'data' => $this->service->list(['visibility' => VisibilityEnum::PUBLIC])?->map(function (EntityDto $dto) {
                return $dto->toArray();
            }),
        ]);
    }
}
