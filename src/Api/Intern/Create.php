<?php

namespace Api\Intern;

use Config\Database;
use Models\Intern;

class Create
{

    public function create(){

        $database = new Database();
        $db = $database->getConnection();

        $items = new Intern($db);

        $data = json_decode(file_get_contents("php://input"));

        $items->fname = $data->fname;
        $items->lname = $data->lname;
        $items->email = $data->email;
        $items->phone = $data->phone;
        $items->group_id = $data->group_id;

        if($items->create()){
            http_response_code(201);
            echo json_encode(array("message" => "Intern created successfully."));
        }else{
            echo json_encode(array("message" => "Intern could not be created."));
        }

    }

}