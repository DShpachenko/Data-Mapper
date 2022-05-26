<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use SecretCompanyName\LaravelAuthId\Helpers\TokenHelper;
use SecretCompanyName\LaravelAuthId\Enums\Auth\Jwt\JwtTypesEnum;

final class FakeTokenHelper
{
    public static function makeToken(): array
    {
        $userId = DB::table('users.users')
            ->insertGetId([
                'status' => 'confirmed',
                'is_referral' => null,
                'registered_on_broker_id' => null,
                'password' => '$2y$10$OrDnd2yV1eT.d5F5UWTzc.N.uhrL7nj9CoXBDofHhYjQpfbljXd4W',
                'created_at' => '2022-03-05 15:38:49',
                'updated_at' => '2022-03-05 15:38:49',
            ]);

        $accountUuid = Str::uuid()->toString();

        DB::table('users.accounts')
            ->insert([
                'uuid' => $accountUuid,
                'user_id' => $userId,
                'status' => 'confirmed',
                'type' => 'broker_super_admin',
                'broker_id' => 3,
                'verified_at' => '2022-03-05 15:38:49',
                'created_at' => '2022-03-05 15:38:49',
                'updated_at' => '2022-03-05 15:38:49',
            ]);

        $token = TokenHelper::generate([
            'data' => [
                'account' => [
                    'type' => 'broker_super_admin',
                    'broker_id' => 3,
                ],
                'account_information' => [
                    'account_uuid' => $accountUuid,
                ],
                'email' => null,
                'phone' => null,
            ],
        ], JwtTypesEnum::TYPE_ACCESS);

        return [
            'token' => $token->getToken(),
            'account_uuid' => $accountUuid,
        ];
    }
}
