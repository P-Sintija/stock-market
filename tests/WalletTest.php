<?php

namespace Tests;

use App\Models\Wallet;
use PHPUnit\Framework\TestCase;

class WalletTest extends TestCase
{
    public function testBudget(): void
    {
        $wallet = new Wallet();
        $wallet->setBudget(234);
        $this->assertGreaterThanOrEqual(0, $wallet->getBudget());
    }
}