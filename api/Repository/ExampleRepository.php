<?php
    namespace WebApp\Platform\OpenApi\Repository;

    use \WebApp\Platform\Core\Database\Repository;
    use \WebApp\Platform\OpenApi\Model\Example;

    final class ExampleRepository implements Repository {
        
        private array $data;

        public function __construct(array $query = []) {
            $this->data = [];
            $resultSet = \WebApp\Platform\Core\Database\MySQLConnection::connect()
            ->query("SELECT 1 as id, 'test' as name;");
            while($row = $resultSet->fetch_object())
                $this->data[] = new Example($row->id, $row->name);
        }

        public function findAll() : array {
            return $this->data;
        }
        public function findById(int $id) : ?object {
            if($id >= 1 && $id <= count($this->data)) return $this->data[$id -1];
            return null;
        }
    }