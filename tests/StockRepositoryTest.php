<?php
namespace Tests;

use App\Models\Stock;
use App\Models\StockCollection;
use App\Repositories\MySQLStockRepository;
use PHPUnit\Framework\TestCase;

class StockRepositoryTest extends TestCase
{
    public function testGetData(): void
    {
        $data = new MySQLStockRepository();
        $this->assertInstanceOf(StockCollection::class, $data->getStockData());
    }

}