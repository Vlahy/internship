<?php

namespace Config;

use PDO;
use PDOException;

class Database
{
    //Database details
    private $host = 'localhost';
    private $dbName = 'internship';
    private $username = 'root';
    private $password = '';
    protected $conn;

    //Database connection

    public function getConnection()
    {
        $this->conn = null;

        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo 'Connection error: ' . $e->getMessage();
        }

        return $this->conn;
    }

}