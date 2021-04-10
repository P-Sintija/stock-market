<?php
namespace Tests;

use App\Models\Wallet;
use App\Repositories\JSONWalletRepository;
use PHPUnit\Framework\TestCase;

class WalletRepositoryTest extends TestCase
{
    public function testGetWallet(): void
    {
        $wallet = new JSONWalletRepository();
        $this->assertInstanceOf(Wallet::class, $wallet->getWallet());
    }
}