<?php

namespace Tests;

use App\Models\Stock;
use PHPUnit\Framework\TestCase;

class StockTest extends TestCase
{
    public function testSymbol(): void
    {
        $stock = new Stock('ABCD', 100, 2, 'active');
        $this->assertIsString($stock->getSymbol());
    }

    public function testPrice(): void
    {
        $stock = new Stock('EFGH', 10, 5, 'active');
        $this->assertIsInt($stock->getPrice());
        $this->assertGreaterThan(0, $stock->getPrice());
    }

    public function testAmount(): void
    {
        $stock = new Stock('CD', 55, 5, 'active');
        $this->assertIsInt($stock->getAmount());
        $this->assertGreaterThan(0, $stock->getAmount());
    }

    public function testStatus(): void
    {
        $stock = new Stock('CDDD', 567, 5, 'active');
        $this->assertEquals('active', $stock->getStatus());

        $stock = new Stock('DD', 5, 5, 'sold', 4, 45);
        $this->assertEquals('sold', $stock->getStatus());
    }

    public function testBenefit(): void
    {
        $stock = new Stock('DD', 5, 5, 'sold', 4, 45);
        $this->assertIsInt($stock->getBenefit());
    }
}
