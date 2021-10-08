<?php

namespace Models;

use Interfaces\CrudInterface;

class Intern implements CrudInterface
{
    //Database
    private $conn;

    //Intern properties
    public $fname;
    public $lname;
    public $email;
    public $phone;
    public $group_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function create(): bool
    {
        $query = "INSERT INTO intern SET fname = :fname, lname = :lname, email = :email, phone = :phone, group_id = :group_id";
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

        if ($stmt2->rowCount() == 0){
            return $rows1;
        }else {
            return array_merge($rows1,$rows2);
        }
    }

    public function update($id): bool
    {
        $query = "UPDATE intern SET fname = :fname, lname = :lname, email = :email, phone = :phone, group_id = :group_id WHERE intern_id = :id";
        $stmt = $this->conn->prepare($query);

        $this->fname = htmlspecialchars(strip_tags($this->fname));
        $this->lname = htmlspecialchars(strip_tags($this->lname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->group_id = htmlspecialchars(strip_tags($this->group_id));

        if($stmt->execute(['id' => $id])){
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $test = $this->conn->prepare("SELECT intern_id FROM intern WHERE intern_id ='" . $id . "'");
        $test->execute(['id' => $id]);
        $test->fetchAll();

        if ($test->rowCount() > 0)
        {
            $query = "DELETE FROM intern WHERE intern_id = :id";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute(['id' => $id]);
        }
        return false;
    }

}