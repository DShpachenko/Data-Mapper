<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Private\Directory\Entity;

use Illuminate\Validation\Rule;
use App\Http\Requests\AbstractRequest;
use App\Dto\Entities\Directory\EntityDto;
use App\Enums\Directory\Entity\VisibilityEnum;

final class ChangeVisibilityRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'integer',
                'exists:App\Models\Directory\Entity,id',
            ],
            'visibility' => [
                'required',
                'string',
                Rule::in(VisibilityEnum::LIST),
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }

    public function dto(): EntityDto
    {
        return EntityDto::fromArray([
            'id' => (int)$this->get('id'),
            'visibility' => $this->get('visibility'),
        ]);
    }
}
