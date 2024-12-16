<?php
require_once 'autoload.php';
require_once(__DIR__.'/vendor/autoload.php');
require_once(__DIR__.'/Router.php');

$router = new Router();
$router->add('GET', '/sort', [\Sort\MainController::class, 'index']);
$router->add('GET', '/fakedata', [\Fakedata\IndexController::class, 'generate']);
$router->add('GET', '/search', [\Search\IndexController::class, 'index']);
$router->add('POST', '/search', [\Search\IndexController::class, 'search']);
$router->add('GET', '/stack', [\Stack\IndexController::class, 'index']);
$router->add('GET', '/deque', [\Deque\IndexController::class, 'index']);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($path);
