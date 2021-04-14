<?php

use App\Controllers\PurchaseController;
use App\Controllers\HomeController;
use App\Controllers\SellController;
use App\Repositories\APIFinnhubRepository;
use App\Repositories\JSONWalletRepository;
use App\Repositories\MySQLSoldRepository;
use App\Repositories\MySQLStockRepository;
use App\Repositories\SoldRepository;
use App\Repositories\StockRepository;
use App\Repositories\WalletRepository;
use App\Services\ClientStockService;
use App\Services\PurchaseStockService;
use App\Services\SellStockService;
use App\Services\StockMarketService;
use App\Services\WalletService;
use Doctrine\Common\Cache\FilesystemCache;
use League\Container\Container;

require_once '../vendor/autoload.php';

session_start();

$container = new Container();
$container->add(StockRepository::class, MySQLStockRepository::class);
$container->add(APIFinnhubRepository::class, APIFinnhubRepository::class)
->addArgument(new FilesystemCache('../Storage/cache'));
$container->add(WalletRepository::class, JSONWalletRepository::class);
$container->add(SoldRepository::class, MySQLSoldRepository::class);

$container->add(ClientStockService::class,ClientStockService::class)
    ->addArguments([StockRepository::class, SoldRepository::class]);

$container->add(StockMarketService::class, StockMarketService::class)
    ->addArgument(APIFinnhubRepository::class);

$container->add(HomeController::class,HomeController::class)
    ->addArguments([ClientStockService::class,StockMarketService::class, WalletService::class]);

$container->add(PurchaseStockService::class,PurchaseStockService::class)
    ->addArgument(StockRepository::class);

$container->add(PurchaseController::class,PurchaseController::class)
->addArguments([PurchaseStockService::class,  WalletService::class]);

$container->add(SellStockService::class,SellStockService::class)
    ->addArguments([StockRepository::class, SoldRepository::class]);

$container->add(SellController::class,SellController::class)
    ->addArguments([SellStockService::class,  WalletService::class]);

$container->add(WalletService::class, WalletService::class)
    ->addArgument(WalletRepository::class);


$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [HomeController::class, 'showPage']);
    $r->addRoute('POST', '/', [HomeController::class, 'getStockPrice']);
    $r->addRoute('GET', '/buy', [PurchaseController::class, 'showPage']);
    $r->addRoute('POST', '/buy', [PurchaseController::class, 'purchase']);
    $r->addRoute('POST', '/sell', [SellController::class, 'sell']);
    $r->addRoute('GET', '/sell', [SellController::class, 'back']);

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