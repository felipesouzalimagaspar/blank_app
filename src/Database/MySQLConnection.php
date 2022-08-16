<?php
namespace WebApp\Platform\Core\Database;

final class MySQLConnection {
    private static ?\mysqli $singleton = null;

    public static function connect() : \mysqli {
        if(self::$singleton === null) {
            self::$singleton = new \mysqli(
                $_ENV['webapp']['platform']['database']['host'],
                $_ENV['webapp']['platform']['database']['user'],
                $_ENV['webapp']['platform']['database']['password'],
                $_ENV['webapp']['platform']['database']['name']
            );
            self::$singleton->set_charset('utf8');
        }
        return self::$singleton;
    }
}