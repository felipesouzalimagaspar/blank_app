<?php
namespace WebApp\Platform\Core\View;

abstract class HTML implements \WebApp\Platform\Core\Utils\Exportable {
    public function __construct(
        public array $stylesheets = [],
        public array $scripts = [],
        public array $content = []        
    ) {}
    public function export() : array {
        return [
            'stylesheets' => $this->stylesheets,
            'scripts' => \WebApp\Platform\Core\Utils\Reducer::reduce($this->scripts),
            'content' => $this->content,
        ];
    }
}