<?php
namespace App\Services;

use App\Repositories\StockRepository;

class BoughtStockService
{
    private StockRepository $stockRepository;

    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function getStockRepository(): StockRepository
    {
        return $this->stockRepository;
    }
}