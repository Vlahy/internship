<?php

namespace Api\Group;

use Config\Database;
use Models\Group;

class Create
{

    public function create()
    {
        $database = new Database();
        $db = $database->getConnection();

        $items = new Group($db);

        $data = json_decode(file_get_contents("php://input"));

        $items->group_name = $data->group_name;

        if($items->create()){
            http_response_code(201);
            echo json_encode(array("message" => "Group created successfully."));
        }else{
            echo json_encode(array("message" => "Group could not be created."));
        }
    }

}