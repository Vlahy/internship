<?php

namespace Models;

use Interfaces\CrudInterface;

class Mentor implements CrudInterface
{
    //Database
    private $conn;

    //Intern properties
    protected $mentor_id;
    protected $mentor_fname;
    protected $mentor_lname;
    protected $email;
    protected $phone;
    protected $group_id;
    protected $group_name;
    protected $comment;
    protected $comment_date;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function read($id)
    {
        $query = "SELECT mentor_id, fname, lname, email, phone, group_name FROM mentor m LEFT JOIN `group` g on m.group_id = g.group_id WHERE m.mentor_id = :id";
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
        $query = "DELETE FROM mentor WHERE mentor_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
    }

    public function createComment()
    {

    }
}