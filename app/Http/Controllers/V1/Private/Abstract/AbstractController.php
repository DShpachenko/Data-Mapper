<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Private\Abstract;

use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller;
use App\Services\V1\Abstract\AbstractService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\V1\Private\Abstract\UpdateRequest;
use App\Http\Requests\V1\Private\Abstract\CreateRequest;

final class AbstractController extends Controller
{
    private AbstractService $service;

    public function __construct(AbstractService $service)
    {
        $this->service = $service;
    }

    public function create(string $schema, string $symbol, CreateRequest $request): JsonResponse
    {
        return response()->json([
            'data' => $this->service->create($schema, $symbol, $request->get('columns')),
        ], Response::HTTP_CREATED);
    }

    public function get(string $schema, string $symbol, int $id): JsonResponse
    {
        return response()->json(['data' => $this->service->get($schema, $symbol, ['id' => $id])]);
    }

    public function all(string $schema, string $symbol): JsonResponse
    {
        return response()->json(['data' => $this->service->list($schema, $symbol)]);
    }

    public function update(string $schema, string $symbol, UpdateRequest $request): JsonResponse
    {
        $columns = $request->get('columns');
        $this->service->update($schema, $symbol, ['id' => $columns['id']], $columns);

        return response()->json();
    }

    public function delete(string $schema, string $symbol, int $id): JsonResponse
    {
        $this->service->delete($schema, $symbol, ['id' => $id]);

        return response()->json();
    }
}
