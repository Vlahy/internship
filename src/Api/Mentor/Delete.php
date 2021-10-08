<?php

namespace Api\Mentor;

use Config\Database;
use Models\Mentor;

class Delete
{
    public function delete($id)
    {

        $database = new Database();
        $db = $database->getConnection();

        $items = new Mentor($db);

        if($items->delete($id)){
                http_response_code(200);
                echo json_encode(array("message" => "Mentor deleted successfully."));
            }else{
                echo json_encode(array("message" => "Failed to delete mentor."));
            }
    }
}