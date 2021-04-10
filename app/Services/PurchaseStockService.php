<?php
namespace App\Services;

use App\Models\Stock;
use App\Repositories\StockRepository;

class PurchaseStockService
{
    private StockRepository $stockRepository;

    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function buyStock(Stock $stock): void
    {
        $this->stockRepository->insertPurchase($stock);
    }


}