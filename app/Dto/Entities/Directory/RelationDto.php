<?php

declare(strict_types=1);

namespace App\Dto\Entities\Directory;

use App\Dto\DtoInterface;

final class RelationDto implements DtoInterface
{
    private int|null $id;

    private int|null $fromEntityId;

    private int|null $toEntityId;

    private int|null $fromColumnId;

    private int|null $toColumnId;

    private string|null $foreign;

    private string|null $references;

    private string|null $table;

    private string|null $createdAt;

    private string|null $updatedAt;

    public function __construct(
        ?int $id,
        ?int $fromEntityId,
        ?int $toEntityId,
        ?int $fromColumnId,
        ?int $toColumnId,
        ?string $foreign,
        ?string $references,
        ?string $table,
        ?string $createdAt,
        ?string $updatedAt
    )
    {
        $this->id = $id;
        $this->fromEntityId = $fromEntityId;
        $this->toEntityId = $toEntityId;
        $this->fromColumnId = $fromColumnId;
        $this->toColumnId = $toColumnId;
        $this->foreign = $foreign;
        $this->references = $references;
        $this->table = $table;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'from_entity_id' => $this->fromEntityId,
            'to_entity_id' => $this->toEntityId,
            'from_column_id' => $this->fromColumnId,
            'to_column_id' => $this->toColumnId,
            'foreign' => $this->foreign,
            'references' => $this->references,
            'table' => $this->table,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public static function fromArray(array $arguments): DtoInterface|RelationDto
    {
        return new self(
            $arguments['id'] ?? null,
            $arguments['from_entity_id'] ?? null,
            $arguments['to_entity_id'] ?? null,
            $arguments['from_column_id'] ?? null,
            $arguments['to_column_id'] ?? null,
            $arguments['foreign'] ?? null,
            $arguments['references'] ?? null,
            $arguments['table'] ?? null,
            $arguments['created_at'] ?? null,
            $arguments['updated_at'] ?? null
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getForeign(): ?string
    {
        return $this->foreign;
    }

    public function getReferences(): ?string
    {
        return $this->references;
    }

    public function getTable(): ?string
    {
        return $this->table;
    }

    public function getFromColumnId(): ?int
    {
        return $this->fromColumnId;
    }

    public function getToColumnId(): ?int
    {
        return $this->toColumnId;
    }

    public function getFromEntityId(): ?int
    {
        return $this->fromEntityId;
    }
}
