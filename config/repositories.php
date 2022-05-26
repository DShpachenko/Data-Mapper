<?php

declare(strict_types=1);

return [

    [
        'interface' => \App\Repositories\Directory\Column\ColumnRepositoryInterface::class,
        'implementation' => \App\Repositories\Directory\Column\PgSqlColumnRepository::class,
    ],

    [
        'interface' => \App\Repositories\Directory\Entity\EntityRepositoryInterface::class,
        'implementation' => \App\Repositories\Directory\Entity\PgSqlEntityRepository::class,
    ],

    [
        'interface' => \App\Repositories\Directory\Relation\RelationRepositoryInterface::class,
        'implementation' => \App\Repositories\Directory\Relation\PgSqlRelationRepository::class,
    ],

    [
        'interface' => \App\Repositories\Schema\SchemaRepositoryInterface::class,
        'implementation' => \App\Repositories\Schema\PgSqlSchemaRepository::class,
    ],

    [
        'interface' => \App\Repositories\Abstract\AbstractRepositoryInterface::class,
        'implementation' => \App\Repositories\Abstract\PgSqlAbstractRepository::class,
    ],

];
