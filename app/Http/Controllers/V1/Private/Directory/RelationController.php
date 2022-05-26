<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Private\Directory;

use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller;
use App\Dto\Entities\Directory\RelationDto;
use App\Services\V1\Directory\RelationService;
use App\Http\Requests\V1\Private\Directory\Relation\AllRequest;

final class RelationController extends Controller
{
    private RelationService $service;

    public function __construct(RelationService $service)
    {
        $this->service = $service;
    }

    public function all(AllRequest $request): JsonResponse
    {
        return response()->json([
            'data' => $this->service->list(array_filter($request->dto()->toArray()))->map(function (RelationDto $dto) {
                return $dto->toArray();
            }),
        ]);
    }
}
