<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Dto\System\EmailDto;
use App\Dto\System\PhoneDto;
use Illuminate\Http\Response;
use App\Dto\System\AccountDto;
use Illuminate\Http\JsonResponse;
use App\Exceptions\System\JwtException;
use App\Dto\System\AccountInformationDto;
use App\Exceptions\System\AccessException;
use SecretCompanyName\LaravelAuthId\Helpers\TokenHelper;

final class SecretCompanyNameIdMiddleware
{
    public function handle(Request $request, Closure $next, ?string $role = null): JsonResponse|Response
    {
        $accessToken = $request->header('Authorization');

        if (is_null($accessToken)) {
            throw new JwtException();
        }

        $accessToken = explode(' ', $accessToken)[1];

        if (!TokenHelper::validation($accessToken)) {
            throw new JwtException();
        }

        $payload = TokenHelper::getPayload($accessToken);

        $account = AccountDto::fromArray($payload['account']);

        if ($role && $role !== $account->getType()) {
            throw new AccessException();
        }

        $request->offsetSet('token_payload', [
            'account' => $account,
            'account_information' => AccountInformationDto::fromArray($payload['account_information']),
            'email' => EmailDto::fromArray($payload['email']),
            'phone' => PhoneDto::fromArray($payload['phone']),
        ]);

        return $next($request);
    }
}
