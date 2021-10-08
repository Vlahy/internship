<?php

namespace Api\Intern;

use Config\Database;
use Models\Intern;

class Delete {

    public function delete($id)
    {
        $database = new Database();
        $db = $database->getConnection();

        $items = new Intern($db);

        if($items->delete($id)){
            http_response_code(200);
            echo json_encode(array("message" => "Intern deleted successfully."));
        }else{
            http_response_code(500);
            echo json_encode(array("message" => "Failed to delete intern."));
        }
    }

}
