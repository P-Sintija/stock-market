<?php
namespace App\Services;

use App\Models\Stock;
use App\Models\StockCollection;
use App\Repositories\StockRepository;

class SellStockService
{

    private StockRepository $stockRepository;

    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function getStocks(): StockCollection
    {
        return $this->stockRepository->getStockData();
    }


    public function search(int $id): Stock
    {
       return $this->stockRepository->searchStock($id);

    }

    public function editStockInfo(Stock $stock, float $currentPrice): void
    {
        $this->stockRepository->edit($stock, $currentPrice);
    }

}