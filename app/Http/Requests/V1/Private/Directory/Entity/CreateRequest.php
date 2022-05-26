<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Private\Directory\Entity;

use Illuminate\Validation\Rule;
use App\Http\Requests\AbstractRequest;
use App\Dto\Entities\Directory\ColumnDto;
use App\Dto\Entities\Directory\EntityDto;
use App\Enums\Directory\Entity\VisibilityEnum;
use App\Dto\Pipelines\Directory\EntityPipelineDto;
use App\Enums\Directory\Entity\TypeEnum as EntityTypeEnum;
use App\Enums\Directory\Column\TypeEnum as ColumnTypeEnum;

final class CreateRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'parent_id' => [
                'integer',
                'exists:App\Models\Directory\Entity,id',
            ],
            'name' => [
                'required',
                'string',
                'min:2',
                'max:100',
            ],
            'symbol' => [
                'required',
                'string',
                'min:2',
                'max:100',
            ],
            'type' => [
                'required',
                Rule::in(EntityTypeEnum::LIST),
            ],
            'visibility' => [
                'required_if:type,' . EntityTypeEnum::TABLE,
                'string',
                Rule::in(VisibilityEnum::LIST),
            ],
            'columns' => [
                'required_if:type,' . EntityTypeEnum::TABLE,
                'array',
            ],
            'columns.*.name' => [
                'required_if:type,' . EntityTypeEnum::TABLE,
                'string',
                'min:2',
                'max:100',
                Rule::notIn(['id']),
            ],
            'columns.*.symbol' => [
                'required_if:type,' . EntityTypeEnum::TABLE,
                'string',
                'min:2',
                'max:100',
                Rule::notIn(['id']),
            ],
            'columns.*.type' => [
                'required_if:type,' . EntityTypeEnum::TABLE,
                'string',
                Rule::in(ColumnTypeEnum::PUBLIC_LIST)
            ],
            'columns.*.relation_id' => [
                'integer',
                'exists:App\Models\Directory\Column,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }

    public function dto(): EntityPipelineDto
    {
        if ($columns = $this->get('columns')) {
            $columnsDto = [];

            foreach ($columns as $column) {
                $columnsDto[] = ColumnDto::fromArray([
                    'name' => $column['name'],
                    'symbol' => $column['symbol'],
                    'type' => $column['type'],
                    'relation_id' => $column['relation_id'] ?? null,
                ]);
            }

            $columns = $columnsDto;
        }

        return new EntityPipelineDto(EntityDto::fromArray($this->only([
            'parent_id',
            'name',
            'symbol',
            'type',
            'visibility',
        ])), $columns, null);
    }
}
