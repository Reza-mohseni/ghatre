<?php

namespace App\Models\ORM;

use App\Models\ORM\Connection;
require_once __DIR__ . '/../ORM/Connection.php';

class QueryBuilder extends Connection {
    protected $connection;
    protected $query;
    protected $params = [];

    public function __construct() {
        $this->connection = Connection::getInstance();
    }

    public function select($columns = '*') {
        $this->query = "SELECT $columns ";
        return $this;
    }

    public function from($table) {
        $this->query .= "FROM $table ";
        return $this;
    }

    public function offset($offset) {
        $this->query .= "OFFSET $offset ";
        return $this;
    }

    public function limit($limit, $limits = null) {
        $this->query .= "LIMIT $limit";
        if ($limits !== null) {
            $this->query .= ", $limits";
        }
        $this->query .= " ";
        return $this;
    }

    public function orderBy($column, $direction = 'ASC') {
        $this->query .= "ORDER BY $column $direction ";
        return $this;
    }

    public function where($column, $operator, $value) {
        $param = $this->bindParam($column, $value);
        $this->query .= "WHERE $column $operator $param ";
        return $this;
    }

    public function groupBy($column) {
        $this->query .= "GROUP BY $column ";
        return $this;
    }

    public function whereLast14Days($column) {
        $this->query .= "WHERE $column >= NOW() - INTERVAL 15 DAY ";
        return $this;
    }

    public function innerJoin($table, $localColumn, $foreignColumn) {
        $this->query .= "INNER JOIN $table ON $localColumn = $foreignColumn ";
        return $this;
    }

    public function execute() {
        $stmt = $this->connection->prepare($this->query);
        $stmt->execute($this->params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function bindParam($key, $value) {
        $param = ":$key";
        $this->params[$key] = $value;
        return $param;
    }
}
