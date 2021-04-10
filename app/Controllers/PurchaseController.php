<?php

namespace App\Controllers;

use App\Models\Stock;
use App\Services\PurchaseStockService;
use App\Services\WalletService;

class PurchaseController
{
    private PurchaseStockService $service;
    private WalletService $wallet;

    public function __construct(PurchaseStockService $service, WalletService $wallet)
    {
        $this->service = $service;
        $this->wallet = $wallet;
    }


    public function purchase(): void
    {
        if ($_SESSION['stock']['price'] * $_SESSION['stock']['amount'] <= $this->wallet->getWalletAmount()) {
            $this->service->buyStock(new Stock(
                $_SESSION['stock']['symbol'],
                $_SESSION['stock']['price'],
                $_SESSION['stock']['amount'],
                $_SESSION['stock']['status'],
            ));
            $_SESSION['wallet']['expenses'] = (int)$_SESSION['stock']['price'] * (int)$_SESSION['stock']['amount'];
            $this->wallet->removeFromWallet($_SESSION['wallet']['expenses']);
            require_once __DIR__ . '/../../public/Views/confirm-purchase.php';
        } else {
            require_once __DIR__ . '/../../public/Views/error.php';
        }
    }

    public function showPage(): void
    {
        require_once __DIR__ . '/../../public/Views/confirm-purchase.php';
    }


}