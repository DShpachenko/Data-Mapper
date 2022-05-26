<?php

declare(strict_types=1);

namespace App\Dto\System;

use App\Dto\DtoInterface;

final class AccountInformationDto implements DtoInterface
{
    private string|null $accountUuid;

    private string|null $name;

    private string|null $surname;

    private string|null $patronymic;

    private string|null $gender;

    private string|null $birthday;

    private string|null $createdAt;

    private string|null $updatedAt;

    public function __construct(
        ?string $accountUuid,
        ?string $name,
        ?string $surname,
        ?string $patronymic,
        ?string $gender,
        ?string $birthday,
        ?string $createdAt,
        ?string $updatedAt
    )
    {
        $this->accountUuid = $accountUuid;
        $this->name = $name;
        $this->surname = $surname;
        $this->patronymic = $patronymic;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromArray(array $arguments): self
    {
        return new self(
            $arguments['account_uuid'] ?? null,
            $arguments['name'] ?? null,
            $arguments['surname'] ?? null,
            $arguments['patronymic'] ?? null,
            $arguments['gender'] ?? null,
            $arguments['birthday'] ?? null,
            $arguments['created_at'] ?? null,
            $arguments['updated_at'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'account_uuid' => $this->accountUuid,
            'name' => $this->name,
            'surname' => $this->surname,
            'patronymic' => $this->patronymic,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function getAccountUuid(): string
    {
        return $this->accountUuid;
    }

    public function setAccountUuid(string $accountUuid): void
    {
        $this->accountUuid = $accountUuid;
    }
}
