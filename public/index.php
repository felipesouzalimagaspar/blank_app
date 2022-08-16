<?php
require_once __DIR__ . '/../config/bootstrap.php';
\WebApp\Platform\Core\Utils\CorsResolver::cors();
\WebApp\Platform\Core\Application::launch();