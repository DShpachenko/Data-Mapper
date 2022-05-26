<?php

declare(strict_types=1);

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->group([
    'namespace' => 'Directory',
    'prefix' => 'directory',
], function () use ($router): void {

    $router->get('entity/all', 'EntityController@all');

});
