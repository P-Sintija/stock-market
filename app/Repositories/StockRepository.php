<?php

namespace App\Repositories;

use App\Models\Stock;
use App\Models\StockCollection;

interface StockRepository
{
    public function getStockData(): StockCollection;

    public function insertPurchase(Stock $stock): void;

    public function searchStock(int $id): Stock;

    public function edit(Stock $stock, string $key, int $value): void;

    public function delete(Stock $stock): void;
}