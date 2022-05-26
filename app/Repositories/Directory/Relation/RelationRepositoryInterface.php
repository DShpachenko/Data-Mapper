<?php

declare(strict_types=1);

namespace App\Repositories\Directory\Relation;

use Illuminate\Support\Collection;
use App\Dto\Entities\Directory\RelationDto;

interface RelationRepositoryInterface
{
    public function create(RelationDto $dto): RelationDto;

    public function get(array $filters): ?RelationDto;

    public function list(array $filters, callable $callback = null): ?Collection;

    public function update(array $filters, array $data): void;

    public function delete(array $filters): void;
}
