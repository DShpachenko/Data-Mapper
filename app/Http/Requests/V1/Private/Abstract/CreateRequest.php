<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Private\Abstract;

use App\Http\Requests\AbstractRequest;

final class CreateRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'columns' => [
                'required',
                'array',
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
