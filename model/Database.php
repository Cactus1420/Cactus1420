<?php

class Database
{

//    const HOST = "md62.wedos.net";
//    const DBNAME = "d231750_devav";
//    const USER = "w231750_devav";
//    const PASS = "xNgK9S2j";

    const HOST = "localhost";
    const DBNAME = "zf";
    const USER = "root";
    const PASS = "";

    private $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=" . self::HOST. ";dbname=" . self::DBNAME,
            self::USER,
            self::PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        $this->conn->query("SET NAMES utf8");
    }

    public function select($sql, $params = [])
    {
        $stmt = $this->execute($sql, $params);

        return $stmt->fetchAll();
    }

    public function selectOne($sql, $params)
    {
        $stmt = $this->execute($sql, $params);
        return $stmt->fetch();
    }

    public function insert($sql, $params)
    {
        $stmt = $this->execute($sql, $params);

        return $this->conn->lastInsertId();
    }

    public function update($sql, $params)
    {
        $stmt = $this->execute($sql, $params);

        return $stmt->rowCount();
    }

    public function delete($sql, $params = [])
    {
        $this->execute($sql, $params);
        //return;
    }

    private function execute($query, $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);

        return $stmt;
    }
}
