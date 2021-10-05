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
        $items->delete($id);

        echo json_encode(array("message" => "Mentor deleted successfully"));
    }
}