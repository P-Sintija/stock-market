<?php
namespace App\Services;

use App\Models\StockCollection;
use App\Repositories\StockRepository;

class ClientStockService
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
}