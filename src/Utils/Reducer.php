<?php
namespace WebApp\Platform\Core\Utils;

final class Reducer {
    public static function reduce(array $array) : array {
        return array_reduce($array, function($carry, $item) {
            $carry[] = $item->export();
            return $carry;
        }, []);
    }
}