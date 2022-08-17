<?php
    ################################################################################
    ### 1) Basic config for WebApp                                               ###
    ################################################################################
    declare(strict_types=1);
    /**  @todo change the APP_MODE to true for production and false for sandbox **/
    const WEBAPP_APP_MODE = false;
    const WEBAPP_VENDOR_PATH = __DIR__ . '/../vendor/autoload.php';
    require_once WEBAPP_VENDOR_PATH;
    const WEBAPP_CONFIG_PATH = __DIR__;
    /** @todo change the config file name **/
    const WEBAPP_CONFIG_APP_FILENAME = 'config.yml';
    /** @todo change configurations for the app. PS.: only change the configurations that are necessary **/
    const WEBAPP_PHP_INI_CONFIGURATION = [
        "memory_limit" => "128M",
        "default_mimetype" => "application/json",
        "default_mimetype" => "text/html",
        "default_charset" => "UTF-8",
        "user_agent" => "WebApp Platform Client",
        "max_execution_time" => "60",
        "display_errors" => WEBAPP_APP_MODE ? '0' : '1'
    ];
    foreach(WEBAPP_PHP_INI_CONFIGURATION 
    as $PHP_INI_PROPERTY_KEY => $PHP_INI_PROPERTY_VALUE)
    ini_set($PHP_INI_PROPERTY_KEY, $PHP_INI_PROPERTY_VALUE);
    require_once WEBAPP_VENDOR_PATH;    
    $_ENV = array_merge($_ENV, \Symfony\Component\Yaml\Yaml::parse(file_get_contents(
        join("/", [WEBAPP_CONFIG_PATH, WEBAPP_CONFIG_APP_FILENAME])
    )));
    ################################################################################
    ### 2) OpenApi config                                                        ###
    ################################################################################
    /** @todo Change to true or false to use the Swagger UI **/    
    const WEBAPP_USING_OPENAPI = true;
    /** @todo Include all directories that contain the OpenAPI files **/
    const WEBAPP_OPENAPI_SCAN_DIRS = [
        __DIR__ . '/../api'
    ];
    const WEBAPP_OPENAPI_CONFIG_DIR = __DIR__ . '/../api/data.yml';
    if(WEBAPP_USING_OPENAPI)
        fwrite(fopen(WEBAPP_OPENAPI_CONFIG_DIR, 'w'), 
            (\OpenApi\Generator::scan(WEBAPP_OPENAPI_SCAN_DIRS))->toYaml());
    ################################################################################
    ### 3) Twig config                                                           ###
    ################################################################################
    const WEBAPP_TWIG_TEMPLATES_DIR = __DIR__ . '/../templates/';
    const WEBAPP_TWIG_LOADER = new \Twig\Loader\FilesystemLoader();
    WEBAPP_TWIG_LOADER->addPath(WEBAPP_TWIG_TEMPLATES_DIR . 'global', 'global');    
    if(WEBAPP_USING_OPENAPI) 
    WEBAPP_TWIG_LOADER->addPath(WEBAPP_TWIG_TEMPLATES_DIR . 'docs', 'docs');
    /**
     * @todo Include the loader for the specific template
     * @example WEBAPP_TWIG_LOADER->addPath(__DIR__ . '/../templates/' . $template, $template);
     */
    WEBAPP_TWIG_LOADER->addPath(WEBAPP_TWIG_TEMPLATES_DIR . 'theme', 'theme');
    /** @todo Change the cache directory and other configurations **/
    const WEBAPP_TWIG_ENVIRONMENT = new \Twig\Environment(WEBAPP_TWIG_LOADER, [
        'cache' => WEBAPP_TWIG_TEMPLATES_DIR . 'cache',
        'charset' => 'utf-8',
        'auto_reload' => true
    ]);
    ################################################################################
    ### 4) Routes config                                                         ###
    ################################################################################
    $router = \Slim\Factory\AppFactory::create();
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Log\LoggerInterface;    
    /**
     * @todo Include all routes and controllers
     */
    require_once __DIR__ . '/../routes/routes.php';
    $defaultErrorHandler = function (
        Request $request,
        Throwable $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails,
        ?LoggerInterface $logger = null
    ) use ($router) {
        if($logger) $logger->error($exception->getMessage());
        $payload = ['error' => $exception->getMessage()];
        $response = $router->getResponseFactory()->createResponse(($payload['error'] == "Not found.") ? 404 : 500);
        $response->getBody()->write(
            json_encode($payload, JSON_UNESCAPED_UNICODE)
        );
        return $response;
    };
    $errorMiddleware = $router->addErrorMiddleware(true, true, true);
    $errorMiddleware->setDefaultErrorHandler($defaultErrorHandler);    
    ################################################################################
    ### 5) Client config                                                         ###
    ################################################################################
    use \WebApp\Platform\Core\Client\Config;
    use \WebApp\Platform\Core\Client\Address;
    use \WebApp\Platform\Core\Client\Phone;
    use \WebApp\Platform\Core\Client\Mail;
    use \WebApp\Platform\Core\Client\SocialNetworks;
    const WEBAPP_CLIENT = new Config(
        'Test Application',
        'Test',
        [new Address('Test','Test','Test','Test','Test','Test')],
        [new Phone('+5528999999999', '28 99999-9999', Phone::CELL_PHONE)],
        [new Mail('test@test.com', 'Test')],
        [new SocialNetworks('https://www.facebook.com/test', SocialNetworks::FACEBOOK)],
    );