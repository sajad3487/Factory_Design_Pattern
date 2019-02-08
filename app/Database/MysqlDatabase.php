<?php

namespace App\Database;

class MysqlDatabase
{

    public $conn;

    public function __construct()
    {
        $host = 'db';
        $dbname = 'database';
        $user = 'user';
        $pass = 'pass';
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
        $this->conn = new \PDO($dsn, $user, $pass);
        $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public static function get_first($table,$field,$data)
    {
        $obj = new self();
        $stmt = $obj->conn->prepare("SELECT * FROM $table WHERE $field='$data' LIMIT 1");
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }

    public static function get_many($table,$field,$data)
    {
        $obj = new self();
        $stmt = $obj->conn->prepare("SELECT * FROM $table WHERE $field='$data'");
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    public static function insert($tableName, $data) {
        $obj = new self();
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
        // Prepare and execute the statement
        $stmt = $obj->conn->prepare($sql);
        $response = $stmt->execute($data);
        $last_id = $obj->conn->lastInsertId();
        return $obj::get_first($tableName,'id',$last_id);
    }

    public static function get_all($table)
    {
        $obj = new self();
        $stmt = $obj->conn->prepare("SELECT * FROM $table");
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    public static function update($table,$data,$id)
    {
        $obj = new self();
        $setValues = [];
        foreach ($data as $key => $value) {
            $setValues[] = "$key = :$key";
        }
        $setClause = implode(', ', $setValues);
        $sql = "UPDATE $table SET $setClause WHERE id = :id";
        $data['id'] = $id;
        $stmt = $obj->conn->prepare($sql);
        $response = $stmt->execute($data);
        if ($response) {
            return true;
        } else {
            return false;
        }
    }
}

