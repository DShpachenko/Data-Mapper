<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Private\Directory\Entity;

use App\Http\Requests\AbstractRequest;
use App\Dto\Entities\Directory\EntityDto;
use App\Dto\Pipelines\Directory\EntityPipelineDto;

final class DeleteRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'id' => [
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

    public function dto(): EntityPipelineDto
    {
        return new EntityPipelineDto(EntityDto::fromArray([
            'id' => (int)$this->get('id'),
        ]), null, null);
    }
}
