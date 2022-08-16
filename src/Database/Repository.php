<?php

namespace WebApp\Platform\Core\Database;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface Repository {
    public function findAll() : array;
    public function findById(int $id) : ?object;
    public function __construct(array $query = []);
}