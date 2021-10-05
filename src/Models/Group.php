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
        //$queryMentor = "SELECT m.mentor_id, m.fname, m.lname FROM mentor m WHERE m.group_id = :id";
        //$queryIntern = "SELECT i.intern_id, i.fname, i.lname FROM intern i WHERE i.group_id = :id";
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