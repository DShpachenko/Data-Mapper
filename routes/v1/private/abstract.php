<?php

declare(strict_types=1);

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->group([
    'namespace' => 'Abstract',
    'prefix' => 'abstract',
], function () use ($router): void {

    $router->post('{schema}/{symbol}', 'AbstractController@create');

    $router->get('{schema}/{symbol}/all', 'AbstractController@all');

    $router->get('{schema}/{symbol}/{id}', 'AbstractController@get');

    $router->patch('{schema}/{symbol}', 'AbstractController@update');

    $router->delete('{schema}/{symbol}/{id}', 'AbstractController@delete');

});
