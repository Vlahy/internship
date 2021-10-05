<?php

// In case one is using PHP 5.4's built-in server
$filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

require __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;

$router = new Router();

$router->setBasePath('/');

// Custom 404 Handler
$router->set404(function () {
    header('HTTP/1.1 404 Not Found');
    header('Content-Type: application/json');

    $jsonArray = array();
    $jsonArray['status'] = "404";
    $jsonArray['status_text'] = "route not defined";

    echo json_encode($jsonArray);
});

$router->before('GET', '/.*', function () {
    header('Content-Type: application/json');
});

$router->get('/', function () {
    echo 'hi';
    //header('Location: /src/Api/Intern/Read.php');
});

//Route for showing intern data
$readIntern = new \Api\Intern\Read();
$router->get('/intern/(\w+)', function ($id) use ($readIntern) {
    $readIntern->read($id);
});

$readMentor = new \Api\Mentor\Read();
$router->get('/mentor/(\w+)', function ($id) use ($readMentor) {
    $readMentor->read($id);
});

$readGroup = new \Api\Group\Read();
$router->get('/group/(\w+)', function ($id) use ($readGroup) {
    echo ($readGroup->read($id));
});

$router->run();
