<?php

declare(strict_types=1);

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->group([
    'namespace' => 'Public',
    'prefix' => 'public',
], function () use ($router): void {

    require_once 'public/directory.php';

    require_once 'public/abstract.php';

});
