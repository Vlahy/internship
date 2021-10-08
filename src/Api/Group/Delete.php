<?php

namespace Api\Group;

use Config\Database;
use Models\Group;

class Delete
{
    public function delete($id)
    {

        $database = new Database();
        $db = $database->getConnection();

        $items = new Group($db);

        if($items->delete($id)){
            http_response_code(200);
            echo json_encode(array("message" => "Group deleted successfully."));
        }else{
            echo json_encode(array("message" => "Failed to delete group."));
        }
    }
}