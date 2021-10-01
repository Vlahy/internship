<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

$id = 5;

use Config\Database;
use Models\Intern;

$database = new Database();
$db = $database->getConnection();

$items = new Intern($db);

$stmt = $items->read($id);

$num = count($stmt);

if ($num > 0){
    echo json_encode($stmt);
}else{
    http_response_code(404);
    echo json_encode(array("message"=>"No record found"));
}
