<?php
namespace WebApp\Platform\Core\View;

final class Metatags implements \WebApp\Platform\Core\Utils\Exportable {
    public const LANG_EN = 'en';
    public const LANG_PTBR = 'pt-BR';
    public const CHARSET_UTF8 = 'UTF-8';
    public const CHARSET_ISO = 'ISO-8859-1';
    public const ROBOTS_FOLLOW_INDEX = 'follow, index';
    public const ROBOTS_NO_FOLLOW_NO_INDEX = 'noindex, nofollow';

    public function __construct(
        public string $title = 'Home',
        public ?string $description = null,
        public ?string $canonical = null,
        public ?string $image = null,
        public string $lang = self::LANG_PTBR,
        public string $charset = self::CHARSET_UTF8,
        public string $robots = self::ROBOTS_FOLLOW_INDEX,
        public array $keywords = [],
    ) {}
    public function export() : array {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'canonical' => $this->canonical,
            'keywords' => join(',', $this->keywords),
            'image' => $this->image,
            'lang' => $this->lang,
            'charset' => $this->charset,
            'robots' => $this->robots,
        ];
    }
}