<?php
namespace WebApp\Platform\Core\Client;

final class Address implements \WebApp\Platform\Core\Utils\Exportable {
    public function __construct(
        public string $address,
        public string $district,
        public string $city,
        public string $state,
        public string $country,
        public string $zipCode
    ) {}
    public function export() : array {
        return [
            'address' => $this->address,
            'district' => $this->district,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'zipCode' => $this->zipCode,
        ];
    }
}