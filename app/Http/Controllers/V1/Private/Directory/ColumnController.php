<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Private\Directory;

use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller;
use App\Dto\Entities\Directory\ColumnDto;
use App\Services\V1\Directory\ColumnService;
use App\Http\Requests\V1\Private\Directory\Column\AllRequest;

final class ColumnController extends Controller
{
    private ColumnService $service;

    public function __construct(ColumnService $service)
    {
        $this->service = $service;
    }

    public function all(AllRequest $request): JsonResponse
    {
        return response()->json([
            'data' => $this->service->list([
                'entity_id' => $request->dto()->getEntityId()
            ])->map(function (ColumnDto $dto) {
                return $dto->toArray();
            }),
        ]);
    }
}
