<?php

namespace App\Services;

use App\Models\SoldStock;
use App\Models\Stock;
use App\Repositories\SoldRepository;
use App\Repositories\StockRepository;

class SellStockService
{

    private StockRepository $stockRepository;
    private SoldRepository $soldRepository;

    public function __construct(StockRepository $stockRepository, SoldRepository $soldRepository)
    {
        $this->stockRepository = $stockRepository;
        $this->soldRepository = $soldRepository;
    }

    public function search(int $id): Stock
    {
        return $this->stockRepository->searchStock($id);
    }

    public function editAmount(Stock $stock, string $key, int $value): void
    {
        $this->stockRepository->edit($stock, $key, $value);
    }

    public function addSell(SoldStock $stock): void
    {
        $this->soldRepository->insertSell($stock);
    }

}