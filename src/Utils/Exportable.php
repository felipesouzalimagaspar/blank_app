<?php
namespace WebApp\Platform\Core\Utils;

interface Exportable {
    public function export() : array;
}