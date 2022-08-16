<?php

namespace WebApp\Platform\Web;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use WebApp\Platform\Core\View\Component;
use WebApp\Platform\Core\View\Metatags;
use WebApp\Platform\Core\View\Script;
use WebApp\Platform\Core\View\Page;

class BaseController implements \WebApp\Platform\Core\Router\Controller {

    protected ?ResponseInterface $response = null;
    protected ?ServerRequestInterface $request = null;
    protected ?array $args = null;

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface {
        $this->response = $response;
        $this->request = $request;
        $this->args = $args;
        $template = WEBAPP_TWIG_ENVIRONMENT->load('@global/pages/empty-skeleton.html.twig');
        $this->response->getBody()->write($template->render($this->export()));
        return $this->response;
    }

    public function export() : array {
        $content = [];
        $components = [
            new Component(
                ['/assets/css/style.min.css'],
                [new Script('/assets/js/main.min.js', Script::DEFER, Script::MODULE),],
                ['foo' => 'bar']
            )
        ];
        $template = '@theme/pages/base.html.twig';
        $styles = [
            '/assets/css/externals.css',
            '/assets/css/variables.css',
            '/assets/css/reset.css',
            '/assets/css/normalize.css',
            '/assets/css/style.css',
        ];
        $scripts = [
            new Script('/assets/js/main.js', Script::DEFER, Script::MODULE),
        ];
        $metatags = new Metatags(
            "Example",
            "Example page",
            null,
            '/assets/images/logo-primary.png',
            Metatags::LANG_PTBR,
            Metatags::CHARSET_UTF8,
            Metatags::ROBOTS_FOLLOW_INDEX,
            ['Example']
        );
        return [
            'page' => (new Page(
                $metatags,
                $components,
                $styles,
                $scripts,
                $content,
                $template
            ))->export(),
            'app' => ['name' => WEBAPP_NAME],
            'client' => WEBAPP_CLIENT->export(),
            'currentDate' => ['year' => date("Y")],
        ];
    }
}