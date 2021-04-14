<?php

namespace App\Services;

use App\Models\SoldStockCollection;
use App\Models\Stock;
use App\Models\StockCollection;
use App\Repositories\SoldRepository;
use App\Repositories\StockRepository;

class ClientStockService
{
    private StockRepository $stockRepository;
    private SoldRepository $soldRepository;

    public function __construct(StockRepository $stockRepository, SoldRepository $soldRepository)
    {
        $this->stockRepository = $stockRepository;
        $this->soldRepository = $soldRepository;
    }

    public function getStocks(): StockCollection
    {
        return $this->stockRepository->getStockData();
    }

    public function getSoldStocks(): SoldStockCollection
    {
        return $this->soldRepository->getStockData();
    }

}