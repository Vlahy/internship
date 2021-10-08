<?php

namespace Api\Group;

use Config\Database;
use Models\Group;

class Update
{

    public function update($id)
    {
        $database = new Database();
        $db = $database->getConnection();

        $data = json_decode(file_get_contents("php://input"));

        $items = new Group($db);

        $items->group_name = $data->group_name;

        if($items->update($id)){
            http_response_code(200);
            echo json_encode(array("message" => "Group updated successfully."));
        }else{
            http_response_code(500);
            echo json_encode(array("message" => "Group could not be updated."));
        }
    }

}