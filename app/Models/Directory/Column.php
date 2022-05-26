<?php

declare(strict_types=1);

namespace App\Models\Directory;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Column
 * @property int $id
 * @property int $entityId
 * @property int $relationId
 * @property string $name
 * @property string $symbol
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 *
 * @package App\Models\Directory
 */
final class Column extends Model
{
    protected $table = 'directories.columns';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'entity_id',
        'relation_id',
        'name',
        'symbol',
        'type',
    ];
}
