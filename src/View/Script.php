<?php
namespace WebApp\Platform\Core\View;

final class Script implements \WebApp\Platform\Core\Utils\Exportable {
    public const DEFER = 'defer';
    public const HEAD = 'head';
    public const FOOTER = 'footer';
    public const NORMAL = 'normal';
    public const MODULE = 'module';

    public function __construct(
        public string $link,
        public string $position = self::DEFER,
        public string $type = self::NORMAL
    ) {}
    public function export() : array {
        return [
            'link' => $this->link,
            'position' => $this->position,
            'type' => $this->type,
        ];
    }
}