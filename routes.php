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
    $jsonArray['status_text'] = "Route not defined";

    echo json_encode($jsonArray);
});

$router->before('GET', '/.*', function () {
    header('Content-Type: application/json');
});

$router->get('/', function () {
    echo 'hi';
});

//Defining routes for handling HTTP Request methods for Intern
$router->mount('/intern', function () use ($router){


    //Route for creating intern
    $router->post('', '\Api\Intern\Create@create');

    //Route for getting Intern data
    $router->get('/(\w+)', '\Api\Intern\Read@read');

    //Route for updating Intern data
    $router->patch('(\w+)', '\Api\Intern\Update@update');

    //Route for deleting intern from Database
    $router->delete('/(\w+)', '\Api\Intern\Delete@delete');
});

//Defining routes for handling HTTP Request methods for Mentor
$router->mount('/mentor', function () use ($router) {

    //Route for creating Mentor
    $router->post('', '\Api\Mentor\Create@create');

    //Route for getting Mentor data
    $router->get('/(\w+)', '\Api\Mentor\Read@read');

    //Route for updating Mentor data
    $router->patch('(\w+)', '\Api\Mentor\Update@update');

    //Route for deleting Mentor from Database
    $router->delete('/(\w+)', '\Api\Mentor\Delete@delete');
});

//Defining routes for handling HTTP Request methods for Group
$router->mount('/group', function () use ($router){

    //Route for creating Group
    $router->post('', '\Api\Group\Create@create');

    //Route for getting Group data
    $router->get('/(\w+)', '\Api\Group\Read@read');

    //Route for updating Group data
    $router->patch('(\w+)', '\Api\Group\Update@update');

    //Route for deleting Group from Database
    $router->delete('/(\w+)', '\Api\Group\Delete@delete');
});



$router->run();
