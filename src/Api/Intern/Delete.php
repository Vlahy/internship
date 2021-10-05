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
        $items->delete($id);

        echo json_encode(array("message" => "Intern deleted successfully"));
    }

}
