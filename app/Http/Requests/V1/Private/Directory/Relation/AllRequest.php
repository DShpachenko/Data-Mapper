<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Private\Directory\Relation;

use App\Http\Requests\AbstractRequest;
use App\Dto\Entities\Directory\RelationDto;

final class AllRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'from_entity_id' => [
                'required_without:to_entity_id',
                'integer',
                'exists:App\Models\Directory\Entity,id',
            ],
            'to_entity_id' => [
                'required_without:from_entity_id',
                'integer',
                'exists:App\Models\Directory\Entity,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }

    public function dto(): RelationDto
    {
        return RelationDto::fromArray([
            'from_entity_id' => (int)$this->get('from_entity_id'),
            'to_entity_id' => (int)$this->get('to_entity_id'),
        ]);
    }
}
