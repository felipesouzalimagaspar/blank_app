<?php

    use WebApp\Platform\OpenApi\Controller\IndexController;
    use WebApp\Platform\OpenApi\Controller\ExampleController;
    use WebApp\Platform\Web\BaseController;

    $prefix = '/api';
    $router->get("{$prefix}", IndexController::class);
    $router->get("{$prefix}/example", ExampleController::class);
    $router->get("/", BaseController::class);