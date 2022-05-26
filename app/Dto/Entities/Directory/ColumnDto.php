<?php

declare(strict_types=1);

namespace App\Dto\Entities\Directory;

use App\Dto\DtoInterface;

final class ColumnDto implements DtoInterface
{
    private int|null $id;

    private int|null $entityId;

    private int|null $relationId;

    private string|null $name;

    private string|null $symbol;

    private string|null $type;

    private string|null $createdAt;

    private string|null $updatedAt;

    private ColumnDto|null $relationObject;

    public function __construct(
        ?int    $id,
        ?int    $entityId,
        ?int    $relationId,
        ?string $name,
        ?string $symbol,
        ?string $type,
        ?string $createdAt,
        ?string $updatedAt
    )
    {
        $this->id = $id;
        $this->entityId = $entityId;
        $this->relationId = $relationId;
        $this->name = $name;
        $this->symbol = $symbol;
        $this->type = $type;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'entity_id' => $this->entityId,
            'relation_id' => $this->relationId,
            'name' => $this->name,
            'symbol' => $this->symbol,
            'type' => $this->type,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public static function fromArray(array $arguments): DtoInterface|self
    {
        return new self(
            $arguments['id'] ?? null,
            $arguments['entity_id'] ?? null,
            $arguments['relation_id'] ?? null,
            $arguments['name'] ?? null,
            $arguments['symbol'] ?? null,
            $arguments['type'] ?? null,
            $arguments['created_at'] ?? null,
            $arguments['updated_at'] ?? null
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function getRelationId(): ?int
    {
        return $this->relationId;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getRelationObject(): ?ColumnDto
    {
        return $this->relationObject ?? null;
    }

    public function setRelationObject(?ColumnDto $relationObject): void
    {
        $this->relationObject = $relationObject;
    }

    public function getEntityId(): ?int
    {
        return $this->entityId;
    }

    public function setEntityId(int $entityId): void
    {
        $this->entityId = $entityId;
    }
}
