<?php

declare(strict_types=1);

namespace App\Dto\System;

use App\Dto\DtoInterface;

final class TokenPayloadDto implements DtoInterface
{
    private AccountDto|null $account;

    private AccountInformationDto|null $accountInformation;

    private EmailDto|null $email;

    private PhoneDto|null $phone;

    public function __construct(
        ?AccountDto $account,
        ?AccountInformationDto $accountInformation,
        ?EmailDto $email,
        ?PhoneDto $phone
    )
    {
        $this->account = $account;
        $this->accountInformation = $accountInformation;
        $this->email = $email;
        $this->phone = $phone;
    }

    public static function fromArray(array $arguments): self
    {
        return new self(
            $arguments['account'] ?? null,
            $arguments['account_information'],
            $arguments['email'] ?? null,
            $arguments['phone'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'account' => $this->account,
            'account_information' => $this->accountInformation,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }

    public function getAccountInformation(): AccountInformationDto
    {
        return $this->accountInformation;
    }

    public function setAccountInformation(AccountInformationDto $accountInformation): void
    {
        $this->accountInformation = $accountInformation;
    }

    public function getAccount(): ?AccountDto
    {
        return $this->account;
    }

    public function getEmail(): ?EmailDto
    {
        return $this->email;
    }

    public function setEmail(?EmailDto $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): ?PhoneDto
    {
        return $this->phone;
    }

    public function setPhone(?PhoneDto $phone): void
    {
        $this->phone = $phone;
    }
}
