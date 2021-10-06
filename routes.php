<?php

// In case one is using PHP 5.4's built-in server
$filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

require __DIR__ . '/vendor/autoload.php';

use Api\Intern\Create as InternCreate;
use Api\Intern\Read as InternRead;
use Api\Intern\Delete as InternDelete;
use Api\Mentor\Read as MentorRead;
use Api\Mentor\Delete as MentorDelete;
use Api\Group\Read as GroupRead;
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

//Defining routes for handling HTTP Request methods for Intern
$router->mount('/intern', function () use ($router){

    //Instantiating classes for Intern
    $insertIntern = new InternCreate();
    $readIntern = new InternRead();
    $deleteIntern = new InternDelete();

    //Route for getting Intern data
    $router->get('/(\w+)', function ($id) use ($readIntern) {
        $readIntern->read($id);
    });

    //Route for creating intern
    $router->post('', function () use ($insertIntern) {
        $insertIntern->create();
    });

    //Route for deleting intern from Database
    $router->delete('/(\w+)', function ($id) use ($deleteIntern) {
        $deleteIntern->delete($id);
    });
});

//Defining routes for handling HTTP Request methods for Mentor
$router->mount('/mentor', function () use ($router) {

    //Instantiating classes for Mentor
    $readMentor = new MentorRead();
    $deleteMentor = new MentorDelete();

    //Route for getting Mentor data
    $router->get('/(\w+)', function ($id) use ($readMentor) {
        $readMentor->read($id);
    });

    //Route for deleting Mentor from Database
    $router->delete('/(\w+)', function ($id) use ($deleteMentor) {
        $deleteMentor->delete($id);
    });
});

//Defining routes for handling HTTP Request methods for Group
$router->mount('/group', function () use ($router){

    //Instantiating classes for Group
    $readGroup = new GroupRead();

    //Route for getting Group data
    $router->get('/(\w+)', function ($id) use ($readGroup) {
        echo ($readGroup->read($id));
    });



});



$router->run();
