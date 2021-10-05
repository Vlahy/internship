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

        $num = count($stmt);

        if ($num > 0){
            return json_encode($stmt);
        }else{
            http_response_code(404);
            return json_encode(array("message"=>"No record found"));
        }
    }
}