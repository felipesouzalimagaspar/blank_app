<?php
namespace WebApp\Platform\Core\View;

class Page extends HTML {
    public function __construct(
        public Metatags $meta,
        public array $components = [],
        public array $stylesheets = [],
        public array $scripts = [],
        public array $content = [],
        public string $template = '@global/pages/empty-skeleton.html.twig',
        public string $urn = '/'
    ) {}
    public function export() : array {
        $stylesheets = $this->stylesheets;
        $scripts = $this->scripts;
        $content = $this->content;
        foreach($this->components as $component) {
            $stylesheets = array_merge($stylesheets, $component->stylesheets);
            $scripts = array_merge($scripts, $component->scripts);
            $content = array_merge($content, $component->content);
        }
        return [
            'stylesheets' => $stylesheets,
            'scripts' => \WebApp\Platform\Core\Utils\Reducer::reduce($scripts),
            'template' => $this->template,
            'content' => $content,
            'meta' => $this->meta->export(),
            'urn' => $this->urn
        ];
    }
}