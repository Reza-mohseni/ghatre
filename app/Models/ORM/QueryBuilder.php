<?php

namespace App\Models\ORM;

use App\Models\ORM\Connection;
require_once __DIR__ . '/../ORM/Connection.php';


class QueryBuilder  extends  Connection{
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

    public function where($column, $operator, $value) {
        $param = $this->bindParam($column, $value);
        $this->query .= "WHERE $column $operator $param ";
        return $this;
    }

    public function andWhere($column, $operator, $value) {
        $param = $this->bindParam($column, $value);
        $this->query .= "AND $column $operator $param ";
        return $this;
    }

    public function orWhere($column, $operator, $value) {
        $param = $this->bindParam($column, $value);
        $this->query .= "OR $column $operator $param ";
        return $this;
    }

    public function limit($limit) {
        $this->query .= "LIMIT $limit ";
        return $this;
    }

    public function offset($offset) {
        $this->query .= "OFFSET $offset ";
        return $this;
    }

    public function orderBy($column, $direction = 'ASC') {
        $this->query .= "ORDER BY $column $direction ";
        return $this;
    }

    public function groupBy($column) {
        $this->query .= "GROUP BY $column ";
        return $this;
    }

    public function having($column, $operator, $value) {
        $param = $this->bindParam($column, $value);
        $this->query .= "HAVING $column $operator $param ";
        return $this;
    }

    public function join($table, $column1, $operator, $column2, $type = 'INNER') {
        $this->query .= "$type JOIN $table ON $column1 $operator $column2 ";
        return $this;
    }

    public function leftJoin($table, $column1, $operator, $column2) {
        return $this->join($table, $column1, $operator, $column2, 'LEFT');
    }

    public function rightJoin($table, $column1, $operator, $column2) {
        return $this->join($table, $column1, $operator, $column2, 'RIGHT');
    }
    public function whereLast15Days($column) {
        $this->query .= "WHERE $column >= NOW() - INTERVAL 15 DAY ";
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
