<?php

namespace App\Services;

use App\Repositories\WalletRepository;

class WalletService
{
    private WalletRepository $wallet;

    public function __construct(WalletRepository $wallet)
    {
        $this->wallet = $wallet;
    }

    public function getWalletAmount(): int
    {
        return $this->wallet->getWallet()->getBudget();
    }

    public function removeFromWallet(int $money): void
    {
        $this->wallet->remove($money);
    }

    public function addToWallet(int $money): void
    {
        $this->wallet->add($money);
    }
}
