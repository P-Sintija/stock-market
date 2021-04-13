<?php

namespace App\Controllers;

use App\Models\SoldStock;
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
        $stock = $this->service->search((int)$_POST['sell']);

        if (isset($_POST['amountSold']) && $_POST['amountSold'] > 0 && $_POST['amountSold'] <= $stock->getAmount()) {

            $currentPrice = $_SESSION['currentPrices'][$_POST['sell']];
            $soldPrice = $currentPrice * $_POST['amountSold'];

            $this->service->editAmount($stock, 'amount', $stock->getAmount() - $_POST['amountSold']);
            $this->service->addSell(new SoldStock(
                $stock->getSymbol(),
                $stock->getPrice(),
                $_POST['amountSold'],
                $currentPrice,
                ($currentPrice - $stock->getPrice()) * $_POST['amountSold']
            ));

            $this->wallet->addToWallet($soldPrice);
            require_once __DIR__ . '/../../public/Views/confirm-sell.php';
        } else {
            $message = 'Invalid amount input';
            require_once __DIR__ . '/../../public/Views/error.php';
        }
    }
}