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

    public function __construct()
    {
        $this->conn = null;

        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            echo 'Connection error: ' .$e->getMessage();
        }

        return $this->conn;
    }

}