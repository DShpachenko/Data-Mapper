<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Private\Directory\Column;

use App\Http\Requests\AbstractRequest;
use App\Dto\Entities\Directory\ColumnDto;

final class AllRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'entity_id' => [
                'required',
                'integer',
                'exists:App\Models\Directory\Entity,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }

    public function dto(): ColumnDto
    {
        return ColumnDto::fromArray(['entity_id' => (int)$this->get('entity_id')]);
    }
}
