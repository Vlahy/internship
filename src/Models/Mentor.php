<?php

namespace Models;

use Interfaces\CrudInterface;

class Mentor implements CrudInterface
{
    //Database
    private $conn;

    //Intern properties
    public $fname;
    public $lname;
    public $email;
    public $phone;
    public $group_id;
    public $comment;
    public $comment_date;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create(): bool
    {
        $query = "INSERT INTO mentor SET fname = :fname, lname = :lname, email = :email, phone = :phone, group_id = :group_id";
        $stmt = $this->conn->prepare($query);

        $this->fname = htmlspecialchars(strip_tags($this->fname));
        $this->lname = htmlspecialchars(strip_tags($this->lname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->group_id = htmlspecialchars(strip_tags($this->group_id));

        $stmt->bindParam(":fname", $this->fname);
        $stmt->bindParam(":lname", $this->lname);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":group_id", $this->group_id);

        if($stmt->execute()){
            return true;
        }
        return false;
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

    public function delete($id): bool
    {

        $test = $this->conn->prepare("SELECT mentor_id FROM mentor WHERE mentor_id ='" . $id . "'");
        $test->execute(['id' => $id]);
        $test->fetchAll();
        if ($test->rowCount() > 0) {

            $query = "DELETE FROM mentor WHERE mentor_id = :id";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute(['id'=>$id]);
        }
        return false;
    }

    public function createComment()
    {

    }
}