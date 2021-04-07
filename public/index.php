<?php

use App\Controllers\HomeController;
use App\Repositories\MySQLStockRepository;
use App\Repositories\StockRepository;
use App\Services\BoughtStockService;
use League\Container\Container;

require_once '../vendor/autoload.php';

$container = new Container();
$container->add(StockRepository::class, MySQLStockRepository::class);

$container->add(BoughtStockService::class,BoughtStockService::class)
    ->addArgument(StockRepository::class);

$container->add(HomeController::class,HomeController::class)
    ->addArgument(BoughtStockService::class);



$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [HomeController::class, 'showPage']);


});


$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];


if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:

        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$controller, $method] = $handler;
        $container->get($controller)->$method($vars);
        break;
}