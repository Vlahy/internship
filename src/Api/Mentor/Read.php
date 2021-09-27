<?php

namespace Api\Mentor;

use Config\Database;

class Read extends Database
{

    public function read($id)
    {

        $query = "SELECT fname, lname, email, phone, group_name FROM internship.mentor m LEFT JOIN internship.group g on m.group_id = g.group_id WHERE m.mentor_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        $rows = $stmt->fetchAll();
        return json_encode($rows);
    }

}