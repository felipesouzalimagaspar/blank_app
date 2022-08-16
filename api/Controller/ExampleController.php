<?php
    namespace WebApp\Platform\OpenApi\Controller;

    use \WebApp\Platform\OpenApi\Repository\ExampleRepository;
    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\ServerRequestInterface;
    use OpenApi\Annotations as OA;

    /**
     * @OA\Get(
     *     path="/api/example",
     *     summary="Examples",
     *     tags={"Example"},
     *     description="Examples",
     *     operationId="Example",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Example")
     *     )
     * )
     */
    final class ExampleController implements \WebApp\Platform\Core\Router\Controller {
        protected ?ResponseInterface $response = null;
        protected ?ServerRequestInterface $request = null;
        protected ?array $args = null;
    
        public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface {
            $this->response = $response;
            $this->request = $request;
            $this->args = $args;
            ini_set("default_mimetype", "application/json");
            $this->response->getBody()->write(json_encode($this->export()));
            return $this->response;
        }

        public function export() : array {
            return ['examples' => (new ExampleRepository)->findAll()];
        }
    }