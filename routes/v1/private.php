<?php

declare(strict_types=1);

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->group([
    'namespace' => 'Private',
    'prefix' => 'private',
], function () use ($router): void {

    require_once 'private/directory.php';

    require_once 'private/abstract.php';

});
