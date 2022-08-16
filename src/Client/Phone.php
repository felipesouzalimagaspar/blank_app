<?php
namespace WebApp\Platform\Core\Client;

final class Phone implements \WebApp\Platform\Core\Utils\Exportable {
    public const CELL_PHONE = 'cell';
    public const HOME_PHONE = 'home';
    public const WORK_PHONE = 'work';
    public const WHATSAPP_PHONE = 'whatsapp';

    public function __construct(
        public string $number,
        public string $label,
        public string $type = self::WHATSAPP_PHONE
    ) {}
    public function export() : array {
        return [
            'number' => $this->number,
            'label' => $this->label,
            'type' => $this->type,
        ];
    }
}