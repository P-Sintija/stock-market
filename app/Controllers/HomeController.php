<?php

namespace App\Controllers;

use App\Repositories\APIFinnhubRepository;
use App\Services\ClientStockService;
use App\Services\WalletService;


class HomeController
{
    private ClientStockService $service;
    private APIFinnhubRepository $stockMarket;
    private WalletService $wallet;

    public function __construct(
        ClientStockService $service,
        APIFinnhubRepository $stockMarket,
        WalletService $wallet)
    {
        $this->service = $service;
        $this->stockMarket = $stockMarket;
        $this->wallet = $wallet;
    }

    public function showPage(): void
    {
        unset($_SESSION['wallet']);
        unset($_SESSION['stock']);
        unset($_SESSION['currentPrices']);

        try {
            $this->wallet->getWalletAmount();
        } catch (\UnexpectedValueException $exception) {
            var_dump($exception->getMessage());
        }

        $_SESSION['wallet']['budget'] = $this->wallet->getWalletAmount();
        $stockList = $this->getStockList();
        $soldStockList = $this->service->getSoldStocks()->getSoldList();

        require_once __DIR__ . '/../../public/Views/home.php';
    }


    public function getStockPrice(): void
    {
        $stockList = $this->getStockList();

        $quote = $this->stockMarket->getQuote($_POST['symbol']);

        if ($quote['c'] == 0) {
            $message = 'Invalid stock Symbol';
            require_once __DIR__ . '/../../public/Views/error.php';
        } else if (!is_numeric($_POST['amount']) || (int)$_POST['amount'] <= 0) {
            $message = 'Invalid amount input';
            require_once __DIR__ . '/../../public/Views/error.php';
        } else {
            $_SESSION['stock']['symbol'] = $_POST['symbol'];
            $_SESSION['stock']['price'] = $quote['c'] * 100;
            $_SESSION['stock']['amount'] = (int)$_POST['amount'];
            require_once __DIR__ . '/../../public/Views/home.php';
        }
    }

    private function getStockList(): array
    {
        $stockList = [];
        if (count($this->service->getStocks()->getStockList()) > 0) {
            foreach ($this->service->getStocks()->getStockList() as $stock) {
                if ($stock->getAmount() <= 0) {
                    $this->service->deleteStock($stock);
                }
                $stockList[$stock->getId()] = [
                    'stock' => $stock,
                    'currentPrice' => (int)($this->stockMarket->getQuote($stock->getSymbol())['c'] * 100)
                ];
                $_SESSION['currentPrices'][$stock->getId()] = (int)($this->stockMarket->getQuote($stock->getSymbol())['c'] * 100);
            }
        }

        return $stockList;
    }

}