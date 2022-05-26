<?php

declare(strict_types=1);

namespace App\Dto\Entities\Directory;

use App\Dto\DtoInterface;

final class EntityDto implements DtoInterface
{
    private int|null $id;

    private int|null $parentId;

    private string|null $schema;

    private string|null $name;

    private string|null $symbol;

    private string|null $type;

    private string|null $visibility;

    private string|null $createdAt;

    private string|null $updatedAt;

    private EntityDto|null $parentObject;

    public function __construct(
        ?int $id,
        ?int $parentId,
        ?string $schema,
        ?string $name,
        ?string $symbol,
        ?string $type,
        ?string $visibility,
        ?string $createdAt,
        ?string $updatedAt
    )
    {
        $this->id = $id;
        $this->parentId = $parentId;
        $this->schema = $schema;
        $this->name = $name;
        $this->symbol = $symbol;
        $this->type = $type;
        $this->visibility = $visibility;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parentId,
            'schema' => $this->schema ?? null,
            'name' => $this->name,
            'symbol' => $this->symbol,
            'type' => $this->type,
            'visibility' => $this->visibility,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public static function fromArray(array $arguments): DtoInterface|self
    {
        return new self(
            $arguments['id'] ?? null,
            $arguments['parent_id'] ?? null,
            $arguments['schema'] ?? null,
            $arguments['name'] ?? null,
            $arguments['symbol'] ?? null,
            $arguments['type'] ?? null,
            $arguments['visibility'] ?? null,
            $arguments['created_at'] ?? null,
            $arguments['updated_at'] ?? null
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getParentObject(): ?EntityDto
    {
        return $this->parentObject ?? null;
    }

    public function setParentObject(?EntityDto $parentObject): void
    {
        $this->parentObject = $parentObject;
    }

    public function getSchema(): ?string
    {
        return $this->schema ?? null;
    }

    public function setSchema(?string $schema): void
    {
        $this->schema = $schema;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getVisibility(): ?string
    {
        return $this->visibility;
    }
}
