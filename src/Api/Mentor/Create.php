<?php

namespace Api\Mentor;

use Config\Database;
use Models\Mentor;

class Create
{

    public function create()
    {
        $database = new Database();
        $db = $database->getConnection();

        $items = new Mentor($db);

        $data = json_decode(file_get_contents("php://input"));

        $items->fname = $data->fname;
        $items->lname = $data->lname;
        $items->email = $data->email;
        $items->phone = $data->phone;
        $items->group_id = $data->group_id;

        if($items->create()){
            http_response_code(201);
            echo json_encode(array("message" => "Mentor created successfully."));
        }else{
            echo json_encode(array("message" => "Mentor could not be created."));
        }
    }

}