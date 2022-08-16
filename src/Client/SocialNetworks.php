<?php
namespace WebApp\Platform\Core\Client;

final class SocialNetworks implements \WebApp\Platform\Core\Utils\Exportable {
    public const FACEBOOK = 'facebook';
    public const TWITTER = 'twitter';
    public const INSTAGRAM = 'instagram';
    public const LINKEDIN = 'linkedin';
    public const YOUTUBE = 'youtube';
    public const GITHUB = 'github';
    public const CALL = 'call';
    public const OTHER = 'other';
    
    public function __construct(
        public string $link,
        public string $type = self::FACEBOOK
    ) {}
    public function export() : array {
        return [
            'link' => $this->link,
            'type' => $this->type,
        ];
    }
}