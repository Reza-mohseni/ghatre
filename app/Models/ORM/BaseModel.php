<?php

namespace App\Models\ORM;

class BaseModel {
    protected $table;
    protected $connection;

    public function __construct() {
        $this->connection = Connection::getInstance();
    }

    public function all() {
        $stmt = $this->connection->query("SELECT * FROM $this->table");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function save($data) {
        if (isset($data['id'])) {
            $this->update($data['id'], $data);
        } else {
            $keys = array_keys($data);
            $fields = implode(',', $keys);
            $placeholders = ':' . implode(', :', $keys);
            $stmt = $this->connection->prepare("INSERT INTO $this->table ($fields) VALUES ($placeholders)");
            $stmt->execute($data);
        }
    }

    public function update($id, $data) {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ', ');
        $stmt = $this->connection->prepare("UPDATE $this->table SET $fields WHERE id = :id");
        $data['id'] = $id;
        $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
