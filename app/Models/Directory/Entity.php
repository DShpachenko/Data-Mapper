<?php

declare(strict_types=1);

namespace App\Models\Directory;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Entity
 * @property int $id
 * @property int $parentId
 * @property string $schema
 * @property string $name
 * @property string $symbol
 * @property string $type
 * @property string $visibility
 * @property string $created_at
 * @property string $updated_at
 *
 * @package App\Models\Directory
 */
final class Entity extends Model
{
    protected $table = 'directories.entities';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'parent_id',
        'schema',
        'name',
        'symbol',
        'type',
        'visibility',
    ];
}
