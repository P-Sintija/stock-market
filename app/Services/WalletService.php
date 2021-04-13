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
        if ($this->wallet->getWallet()->getBudget() < 0) {
            throw new \UnexpectedValueException('Invalid budget amount!');
        }
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
