<?php

namespace Models;

use Interfaces\CrudInterface;

class Group implements CrudInterface
{
    private $conn;

    public $group_name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO `group` SET group_name = :group_name";
        $stmt = $this->conn->prepare($query);

        $this->group_name = htmlspecialchars(strip_tags($this->group_name));

        $stmt->bindParam(':group_name', $this->group_name);

        if ($stmt->execute()){
            return true;
        }
        return false;

    }

    public function read($id): array
    {
        $query = "SELECT group_id, group_name FROM `group` WHERE group_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll();
    }

    public function update($id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}