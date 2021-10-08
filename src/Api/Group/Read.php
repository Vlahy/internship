<?php

namespace Api\Group;

use Config\Database;
use Models\Group;

class Read
{

    public function read($id)
    {
        $database = new Database();
        $db = $database->getConnection();

        $items = new Group($db);

        $stmt = $items->read($id);

        if (count(json_decode($stmt))){
            echo $stmt;
        }else{
            http_response_code(404);
            echo json_encode(array("message"=>"No record found"));
        }
    }
}