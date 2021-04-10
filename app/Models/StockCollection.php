<?php
namespace App\Models;

class StockCollection
{
    private array $stockList = [];

    public function addStock(Stock $stock): void
    {
        $this->stockList[] = $stock;
    }

    public function getStockList(): array
    {
        return $this->stockList;
    }
}