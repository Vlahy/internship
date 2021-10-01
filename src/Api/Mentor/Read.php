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

        //Checks if there is mentor in database
        if ($stmt->rowCount() !=0){
            //Return mentor from database in json format
            return json_encode($rows);
        }else{
            //Add error code
            return "Error";
        }
    }

}