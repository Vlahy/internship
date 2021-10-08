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

    public function create(): bool
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
        $query = "SELECT group_id, group_name FROM `group` g WHERE g.group_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll();
    }

    public function update($id): bool
    {
        $query = "UPDATE `group` g SET g.group_name = :group_name WHERE g.group_id = :id";
        $stmt = $this->conn->prepare($query);

        $this->group_name = htmlspecialchars(strip_tags($this->group_name));

        $stmt->bindParam(":group_name", $this->group_name);
        $stmt->bindParam(":id", $id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function delete($id): bool
    {
        $test = $this->conn->prepare("SELECT group_id FROM `group` g WHERE g.group_id ='" . $id . "'");
        $test->execute();
        $test->fetchAll();

        if ($test->rowCount() > 0) {

            $query = "DELETE FROM `group` g WHERE g.group_id = :id";
            $stmt1 = $this->conn->prepare($query);

            $testIntern = $this->conn->prepare("SELECT group_id FROM intern i WHERE i.group_id ='" . $id . "'");
            $testIntern->execute();
            $testIntern->fetchAll();

            $testMentor = $this->conn->prepare("SELECT group_id FROM mentor m WHERE m.group_id ='" . $id . "'");
            $testMentor->execute();
            $testMentor->fetchAll();

            if($testIntern->rowCount() > 0 && $testMentor->rowCount() > 0){
                $queryUpdateIntern = "UPDATE intern i SET i.group_id = null WHERE i.group_id = :id";
                $queryUpdateMentor = "UPDATE mentor m SET m.group_id = null WHERE m.group_id = :id";
                $stmt2 = $this->conn->prepare($queryUpdateIntern);
                $stmt3 = $this->conn->prepare($queryUpdateMentor);
                $stmt1->execute(['id' => $id]);
                $stmt2->execute(['id' => $id]);
                $stmt3->execute(['id' => $id]);
                return true;
            }elseif($testIntern->rowCount() > 0) {
                $queryUpdateIntern = "UPDATE intern i SET i.group_id = null WHERE i.group_id = :id";
                $stmt2 = $this->conn->prepare($queryUpdateIntern);
                $stmt1->execute(['id' => $id]);
                $stmt2->execute(['id' => $id]);
                return true;
            }elseif($testMentor->rowCount() > 0){
                $queryUpdateMentor = "UPDATE mentor m SET m.group_id = null WHERE m.group_id = :id";
                $stmt2 = $this->conn->prepare($queryUpdateMentor);
                $stmt1->execute(['id' => $id]);
                $stmt2->execute(['id' => $id]);
                return true;
            }else{
                $stmt1->execute(['id' => $id]);
                return true;
            }
        }
        return false;
    }
}