<?php

declare(strict_types=1);

namespace App\Dto\System;

use App\Dto\DtoInterface;

final class AccountDto implements DtoInterface
{
    private string|null $uuid;

    private int|null $userId;

    private int|null $accountType;

    private string|null $status;

    private string|null $type;

    private int|null $brokerId;

    private string|null $verifiedAt;

    private string|null $createdAt;

    private string|null $updatedAt;

    public function __construct(
        ?int $uuid,
        ?int $userId,
        ?int $accountType,
        ?string $status,
        ?string $type,
        ?int $brokerId,
        ?string $verifiedAt,
        ?string $createdAt,
        ?string $updatedAt
    )
    {
        $this->uuid = $uuid;
        $this->userId = $userId;
        $this->accountType = $accountType;
        $this->status = $status;
        $this->type = $type;
        $this->brokerId = $brokerId;
        $this->verifiedAt = $verifiedAt;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(array $arguments): self
    {
        return new self(
            $arguments['uuid'] ?? null,
            $arguments['user_id'] ?? null,
            $arguments['account_type'] ?? null,
            $arguments['status'] ?? null,
            $arguments['type'] ?? null,
            $arguments['broker_id'] ?? null,
            $arguments['verified_at'] ?? null,
            $arguments['created_at'] ?? null,
            $arguments['updated_at'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'uuid' => $this->uuid,
            'user_id' => $this->userId,
            'account_type' => $this->accountType,
            'status' => $this->status,
            'type' => $this->type,
            'broker_id' => $this->brokerId,
            'verified_at' => $this->verifiedAt,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function getUuid(): ?int
    {
        return $this->uuid;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getBrokerId(): ?int
    {
        return $this->brokerId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
