<?php

namespace Tests;

use App\Models\Stock;
use PHPUnit\Framework\TestCase;

class StockTest extends TestCase
{
    public function testSymbol(): void
    {
        $stock = new Stock('ABCD', 100, 2);
        $this->assertIsString($stock->getSymbol());
    }

    public function testPrice(): void
    {
        $stock = new Stock('EFGH', 10, 5);
        $this->assertIsInt($stock->getPrice());
        $this->assertGreaterThan(0, $stock->getPrice());
    }

    public function testAmount(): void
    {
        $stock = new Stock('CD', 55, 5);
        $this->assertIsInt($stock->getAmount());
        $this->assertGreaterThan(0, $stock->getAmount());
    }
}
