<?php
namespace WebApp\Platform\Core;

final class Application {
    public static function launch() : void {
        global $router;
        $router->run();        
    }
}