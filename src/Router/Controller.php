<?php

namespace WebApp\Platform\Core\Router;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface Controller extends \WebApp\Platform\Core\Utils\Exportable {
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface;    
}