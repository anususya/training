<?php
require_once 'autoload.php';
require_once (__DIR__.'/vendor/autoload.php');
require_once (__DIR__.'/Router.php');

/**
$route = $_SERVER['REQUEST_URI'] ?? '';

$params = explode('/', trim($route,'/'));

if (!empty($params[0])) {
    $controller = new \Sort\MainController;
    //$controller = new \Fakedata\IndexController;
    if (isset($params[1])) {
        $controller->$params[1]();
    } else {
        $controller->index();
    }
    return;
}

function main()
{
 * */
    $router = new Router();
    $router->add('GET', '/sort', [\Sort\MainController::class, 'index']);
    $router->add('GET', '/fakedata', [\Fakedata\IndexController::class, 'generate']);
    $router->add('POST', '/search', [\Search\IndexController::class, 'index']);

    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $router->dispatch($path);
//}