<?php
namespace App\Models;

class SoldStockCollection
{
    private array $soldStockList = [];

    public function addSold(SoldStock $stock): void
    {
        $this->soldStockList[] = $stock;
    }

    public function getSoldList(): array
    {
        return $this->soldStockList;
    }
}