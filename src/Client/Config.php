<?php
namespace WebApp\Platform\Core\Client;

class Config implements \WebApp\Platform\Core\Utils\Exportable {
    public function __construct(
        public string $fullName,
        public string $shortName,
        public array $address = [],
        public array $phones = [],
        public array $mails = [],
        public array $socialNetworks = [],

    ) {}
    public function export() : array {     
        return [
            'fullName' => $this->fullName,
            'shortName' => $this->shortName,
            'address' => \WebApp\Platform\Core\Utils\Reducer::reduce($this->address),
            'phones' => \WebApp\Platform\Core\Utils\Reducer::reduce($this->phones),
            'mails' => \WebApp\Platform\Core\Utils\Reducer::reduce($this->mails),
            'socialNetworks' => \WebApp\Platform\Core\Utils\Reducer::reduce($this->socialNetworks),
        ];
    }
}