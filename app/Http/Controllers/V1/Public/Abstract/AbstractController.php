<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Public\Abstract;

use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller;
use App\Services\V1\Directory\EntityService;
use App\Services\V1\Abstract\AbstractService;
use App\Enums\Directory\Entity\VisibilityEnum;
use App\Exceptions\Abstract\ForbiddenAccessException;

final class AbstractController extends Controller
{
    private AbstractService $abstractService;

    private EntityService $entityService;

    public function __construct(AbstractService $abstractService, EntityService $entityService)
    {
        $this->entityService = $entityService;
        $this->abstractService = $abstractService;
    }

    public function all(string $schema, string $symbol): JsonResponse
    {
        if (!$this->entityService->get([
            'schema' => $schema,
            'symbol' => $symbol,
            'visibility' => VisibilityEnum::PUBLIC,
        ])) {
            throw new ForbiddenAccessException();
        }

        return response()->json(['data' => $this->abstractService->list($schema, $symbol)]);
    }
}
