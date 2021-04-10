<?php
namespace App\Repositories;

use App\Models\Wallet;

interface WalletRepository
{
    public function getWallet(): Wallet;

    public function remove(int $money): void;

    public function add(int $money): void;

}
