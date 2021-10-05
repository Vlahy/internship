<?php

namespace Models;

use Interfaces\CrudInterface;

class Group implements CrudInterface
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function read($id): array
    {
        $query = "SELECT group_id, group_name FROM `group` WHERE group_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll();
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}