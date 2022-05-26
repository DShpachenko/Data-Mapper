<?php

declare(strict_types=1);

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->group([
    'namespace' => 'Abstract',
    'prefix' => 'abstract',
], function () use ($router): void {

    $router->get('{schema}/{symbol}', 'AbstractController@all');

});
