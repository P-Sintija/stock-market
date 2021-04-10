<?php

namespace App\Controllers;

use App\Services\SellStockService;
use App\Services\WalletService;

class SellController
{
    private SellStockService $service;
    private WalletService $wallet;

    public function __construct(SellStockService $service, WalletService $wallet)
    {
        $this->service = $service;
        $this->wallet = $wallet;
    }

    public function sell(): void
    {
        $stock = $this->service->search((int)$_POST[key($_POST)]);
        $currentPrice = $_SESSION['currentPrices'][$_POST[key($_POST)]];
        $benefit = $currentPrice * $stock->getAmount();

        $this->service->editStockInfo($stock, $currentPrice);
        $this->wallet->addToWallet($benefit);

        require_once __DIR__ . '/../../public/Views/confirm-sell.php';
    }

}