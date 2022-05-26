<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Private\Abstract;

use App\Http\Requests\AbstractRequest;

final class UpdateRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'columns' => [
                'required',
                'array',
            ],
            'columns.id' => [
                'required',
                'integer',
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
