<?php

namespace Api\Intern;

use Config\Database;
use Models\Intern;

class Update
{
    public function update($id){

        $database = new Database();
        $db = $database->getConnection();

        $items = new Intern($db);

        $data = json_decode(file_get_contents("php://input"));

        $items->fname = $data->fname;
        $items->lname = $data->lname;
        $items->email = $data->email;
        $items->phone = $data->phone;
        $items->group_id = $data->group_id;

        if($items->update($id)){
            http_response_code(200);
            echo json_encode(array("message" => "Intern updated successfully."));
        }else{
            http_response_code(500);
            echo json_encode(array("message" => "Intern could not be updated."));
        }

    }
}