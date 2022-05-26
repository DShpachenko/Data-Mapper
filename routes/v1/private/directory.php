<?php

declare(strict_types=1);

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->group([
    'namespace' => 'Directory',
    'prefix' => 'directory',
], function () use ($router): void {

    $router->group([
        'prefix' => 'entity',
    ], function () use ($router): void {
        $router->post('', 'EntityController@create');
        $router->post('change/visibility', 'EntityController@changeVisibility');
        $router->get('all', 'EntityController@all');
        $router->delete('', 'EntityController@delete');
    });

    $router->group([
        'prefix' => 'column',
    ], function () use ($router): void {
        $router->get('all', 'ColumnController@all');
    });

    $router->group([
        'prefix' => 'relation',
    ], function () use ($router): void {
        $router->get('all', 'RelationController@all');
    });

});
