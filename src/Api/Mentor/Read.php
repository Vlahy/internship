<?php

namespace Api\Mentor;

use Config\Database;
use Models\Mentor;

class Read
{

    public function read($id)
    {
        $database = new Database();
        $db = $database->getConnection();

        $items = new Mentor($db);

        $stmt = $items->read($id);

        $num = count($stmt);

        if ($num > 0){
            echo json_encode($stmt);
        }else{
            http_response_code(404);
            echo json_encode(array("message"=>"No record found"));
        }
    }



}