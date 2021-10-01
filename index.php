<?php

// In case one is using PHP 5.4's built-in server
$filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

require __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;

$router = new Router();

//$router->setBasePath('/');

// Custom 404 Handler
$router->set404(function () {
    header('HTTP/1.1 404 Not Found');
    echo '404, route not found!';
});

$router->before('GET', '/.*', function () {
    header('Content-Type: application/json');
});

$router->get('/', function () {
    echo 'hi';
    //header('Location: /src/Api/Intern/Read.php');
});

$router->get('/intern/', function () {
    header('Location: /src/Api/Intern/Read.php');
});

$router->run();
