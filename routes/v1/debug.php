<?php

declare(strict_types=1);

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->group([
    'namespace' => 'Debug',
    'prefix' => 'debug',
], function () use ($router): void {

    $router->get('public/openapi.yaml', 'OpenApiController@public');

    $router->get('private/openapi.yaml', 'OpenApiController@private');

    $router->get('integration/openapi.yaml', 'OpenApiController@integration');

});
