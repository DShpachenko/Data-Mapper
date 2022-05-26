<?php

declare(strict_types=1);

namespace App\Models\Directory;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Relation
 * @property int $id
 * @property int $fromEntityId
 * @property int $toEntityId
 * @property string $foreign
 * @property string $references
 * @property string $table
 * @property string $created_at
 * @property string $updated_at
 *
 * @package App\Models\Directory
 */
final class Relation extends Model
{
    protected $table = 'directories.relations';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'from_entity_id',
        'to_entity_id',
        'from_column_id',
        'to_column_id',
        'foreign',
        'references',
        'table',
    ];
}
