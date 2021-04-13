<?php

namespace App\Repositories;

use App\Models\SoldStock;
use App\Models\SoldStockCollection;

interface SoldRepository
{
    public function getStockData(): SoldStockCollection;

    public function insertSell(SoldStock $stock): void;
}