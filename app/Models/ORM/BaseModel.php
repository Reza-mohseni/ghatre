<?php

namespace App\Models\ORM;
use App\Models\ORM\Connection;
require_once __DIR__ . '/../ORM/Connection.php';

class BaseModel extends Connection{
    protected $table;
    protected $connection;

    public function __construct() {
        $this->connection = Connection::getInstance();
    }

    public function all() {
        $stmt = $this->connection->query("SELECT * FROM $this->table");
        return $stmt->fetchAll();
    }


    public function Find($PhoneNumber='', $Email='') {
        if ($PhoneNumber != '' && $Email != '') {
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE PhoneNumber = :PhoneNumber OR Email = :Email");
            $stmt->execute(['PhoneNumber' => $PhoneNumber, 'Email' => $Email]);
            return $stmt->fetch();
        } elseif ($PhoneNumber != '') {
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE PhoneNumber = :PhoneNumber");
            $stmt->execute(['PhoneNumber' => $PhoneNumber]);
            return $stmt->fetch();
        } elseif ($Email != '') {
            $stmt = $this->connection->prepare("SELECT * FROM $this->table WHERE Email = :Email");
            $stmt->execute(['Email' => $Email]);
            return $stmt->fetch();
        }
    }


    public function save($data) {
        try {
            if (isset($data['id'])) {
                return $this->update($data['id'], $data);
            } else {
                $keys = array_keys($data);
                $fields = implode(',', $keys);
                $placeholders = ':' . implode(', :', $keys);
                $stmt = $this->connection->prepare("INSERT INTO $this->table ($fields) VALUES ($placeholders)");
                $stmt->execute($data);
                return 'Success';
            }
        } catch (\PDOException $e) {

            $Message= "Error: " . $e->getMessage();
            return $Message;
        }
    }


    public function update($id, $data) {
        try {
            $fields = '';
            foreach ($data as $key => $value) {
                $fields .= "$key = :$key, ";
            }
            $fields = rtrim($fields, ', ');
            $stmt = $this->connection->prepare("UPDATE $this->table SET $fields WHERE id = :id");
            $data['id'] = $id;
            $stmt->execute($data);
            return $stmt->rowCount();
        } catch (\PDOException $e) {
            // مدیریت خطا
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM $this->table WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->rowCount();
        } catch (\PDOException $e) {
            // مدیریت خطا
            return false;
        }
    }
}
