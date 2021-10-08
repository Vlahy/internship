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

        if (count($stmt) > 0){

            if(isset($_GET['page'])) {
                $perPage = 5;
                $currentPage = $_GET['page'] ?? 1;
                $offset = ($currentPage - 1) * $perPage;

                echo json_encode(array_slice($stmt, $offset, $perPage));
            }else{
                echo json_encode($stmt);
            }

        }else{
            http_response_code(404);
            echo json_encode(array("message"=>"No record found"));
        }
    }
}