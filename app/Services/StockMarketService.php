<?php

namespace App\Services;

use App\Repositories\APIFinnhubRepository;

class StockMarketService
{
    private APIFinnhubRepository $stockRepository;

    public function __construct(APIFinnhubRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function getQuote(string $symbol): string
    {
        return $this->stockRepository->getCache($symbol);
    }
}