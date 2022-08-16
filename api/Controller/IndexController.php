<?php

namespace WebApp\Platform\OpenApi\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class IndexController implements \WebApp\Platform\Core\Router\Controller {
    protected ?ResponseInterface $response = null;
    protected ?ServerRequestInterface $request = null;
    protected ?array $args = null;

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface {
        $this->response = $response;
        $this->request = $request;
        $this->args = $args;
        ini_set("default_mimetype", "text/html");
        $template = WEBAPP_TWIG_ENVIRONMENT->load('@docs/swagger.twig');
        $this->response->getBody()->write($template->render($this->export()));
        return $this->response;
    }
    public function export() : array {
        $specs = json_encode(\Symfony\Component\Yaml\Yaml::parseFile(__DIR__ . '/../data.yml'));
        return ['spec' => $specs];
    }
}