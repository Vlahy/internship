<?php

namespace Models;

use Interfaces\CrudInterface;

class Intern implements CrudInterface
{
    //Database
    private $conn;

    //Intern properties
    public $intern_id;
    public $intern_fname;
    public $intern_lname;
    public $email;
    public $phone;
    public $group_id;
    public $group_name;
    public $comment;
    public $comment_date;

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
        $internQuery = "SELECT intern_id, fname, lname, email, phone, group_name FROM internship.intern i LEFT JOIN internship.group g on i.group_id = g.group_id WHERE i.intern_id = :id";
        $commentQuery = "SELECT comment_id, comment, comment_date, m.fname, m.lname FROM internship.comments c LEFT JOIN mentor m on c.mentor_id = m.mentor_id WHERE c.intern_id = :id ORDER BY c.comment_date";
        $stmt1 = $this->conn->prepare($internQuery);
        $stmt2 = $this->conn->prepare($commentQuery);
        $stmt1->execute(['id' => $id]);
        $stmt2->execute(['id' => $id]);
        $rows1 = $stmt1->fetchAll();
        $rows2 = $stmt2->fetchAll();

        // Checks if there are comments for intern
        if ($stmt2->rowCount() == 0){
            return $rows1;
        }else {
            return array_merge($rows1,$rows2);
        }
    }

    public function update($id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        $query = "DELETE FROM intern WHERE intern_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
    }

}