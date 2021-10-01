<?php

namespace Api\Group;

use Config\Database;

class Read extends Database
{

    public function read($id)
    {
        $queryGroup = "SELECT group_id, group_name FROM `group` WHERE group_id = :id";
        $queryMentor = "SELECT m.fname, m.lname, i.fname, i.lname FROM internship.mentor m LEFT JOIN intern i on m.group_id = i.group_id WHERE m.group_id = :id";
        $stmt1 = $this->conn->prepare($queryGroup);
        $stmt2 = $this->conn->prepare($queryMentor);
        $stmt1->execute(['id' => $id]);
        $stmt2->execute(['id' => $id]);
        $rows1 = $stmt1->fetchAll();
        $rows2 = $stmt2->fetchAll();
        return json_encode(array_merge($rows1,$rows2));
    }

}