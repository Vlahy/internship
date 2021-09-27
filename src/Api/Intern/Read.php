<?php

namespace Api\Intern;

use Config\Database;

class Read extends Database
{

    public function read($id)
    {
        $internQuery = "SELECT fname, lname, email, phone, group_name FROM internship.intern i LEFT JOIN internship.group g on i.group_id = g.group_id WHERE i.intern_id = :id";
        $commentQuery = "SELECT * FROM internship.comments c WHERE c.intern_id = :id ORDER BY c.comment_date";
        $stmt1 = $this->conn->prepare($internQuery);
        $stmt2 = $this->conn->prepare($commentQuery);
        $stmt1->execute(['id' => $id]);
        $stmt2->execute(['id' => $id]);
        $rows1 = $stmt1->fetchAll();
        $rows2 = $stmt2->fetchAll();

        // Checks if there are comments for intern
        if ($stmt2->rowCount() == 0){
            return json_encode($rows1);
        }else {
            return json_encode($rows1) . json_encode($rows2);
        }
    }

}