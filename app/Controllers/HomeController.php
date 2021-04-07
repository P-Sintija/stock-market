<?php

namespace App\Controllers;

use App\Services\BoughtStockService;

class HomeController
{
    private BoughtStockService $service;
    public function __construct(BoughtStockService $service)
    {
        $this->service = $service;
    }
    public function showPage(): void
    {
       $stockList = $this->service->getStockRepository()->getStockData();



        require_once __DIR__ . '/../../public/view.php';
    }

}