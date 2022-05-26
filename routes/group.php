<?php

declare(strict_types=1);

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->group([
    'namespace' => 'V1',
    'prefix' => 'v1',
], function () use ($router): void {

    require_once 'v1/debug.php';

    require_once 'v1/private.php';

    require_once 'v1/public.php';

});
