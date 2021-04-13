<?php

namespace Tests;

use App\Models\SoldStock;
use PHPUnit\Framework\TestCase;

class SoldStockTest extends TestCase
{
    public function testSymbol(): void
    {
        $stock = new SoldStock('ABCD', 100, 2, 200, 200);
        $this->assertIsString($stock->getSymbol());
    }

    public function testPurchasePrice(): void
    {
        $stock = new SoldStock('ABCD', 100, 2, 200, 200);
        $this->assertIsInt($stock->getPurchasePrice());
        $this->assertGreaterThan(0, $stock->getPurchasePrice());
    }

    public function testAmount(): void
    {
        $stock = new SoldStock('ABCD', 100, 2, 200, 200);
        $this->assertIsInt($stock->getAmount());
        $this->assertGreaterThan(0, $stock->getAmount());
    }

    public function testSoldPrice(): void
    {
        $stock = new SoldStock('ABCD', 100, 2, 200, 200);
        $this->assertIsInt($stock->getSoldPrice());
        $this->assertGreaterThan(0, $stock->getSoldPrice());
    }

    public function testBenefit(): void
    {
        $stock = new SoldStock('ABCD', 100, 2, 200, 200);
        $this->assertIsInt($stock->getBenefit());
        $this->assertEquals(
            ($stock->getSoldPrice() - $stock->getPurchasePrice()) * $stock->getAmount(),
            $stock->getBenefit());
    }

}