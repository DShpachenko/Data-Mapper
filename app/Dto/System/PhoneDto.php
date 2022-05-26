<?php

declare(strict_types=1);

namespace App\Dto\System;

use App\Dto\DtoInterface;

final class PhoneDto implements DtoInterface
{
    private string|null $accountUuid;

    private int|null $phone;

    private string|null $status;

    private string|null $type;

    private string|null $verifiedAt;

    private string|null $createdAt;

    private string|null $updatedAt;

    public function __construct(
        ?string $accountUuid,
        ?int $phone,
        ?string $status,
        ?string $type,
        ?string $verifiedAt,
        ?string $createdAt,
        ?string $updatedAt
    )
    {
        $this->accountUuid = $accountUuid;
        $this->phone = $phone;
        $this->status = $status;
        $this->type = $type;
        $this->verifiedAt = $verifiedAt;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(?array $arguments): DtoInterface|self
    {
        return new self(
            $arguments['account_uuid'] ?? null,
            $arguments['phone'] ?? null,
            $arguments['status'] ?? null,
            $arguments['type'] ?? null,
            $arguments['verified_at'] ?? null,
            $arguments['created_at'] ?? null,
            $arguments['updated_at'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'account_uuid' => $this->accountUuid,
            'phone' => $this->phone,
            'status' => $this->status,
            'type' => $this->type,
            'verified_at' => $this->verifiedAt,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function getAccountUuid(): ?string
    {
        return $this->accountUuid;
    }

    public function setAccountUuid(string $accountUuid): void
    {
        $this->accountUuid = $accountUuid;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }
}
