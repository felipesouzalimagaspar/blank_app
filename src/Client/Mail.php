<?php
namespace WebApp\Platform\Core\Client;

final class Mail implements \WebApp\Platform\Core\Utils\Exportable {
    public function __construct(
        public string $address,
        public string $name
    ) {}
    public function export() : array {
        return [
            'address' => $this->address,
            'name' => $this->name
        ];
    }
}