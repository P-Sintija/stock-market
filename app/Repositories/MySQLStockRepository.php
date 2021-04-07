<?php
namespace App\Repositories;


use App\Models\Stock;
use App\Models\StockCollection;
use Medoo\Medoo;

class MySQLStockRepository implements StockRepository
{
    private Medoo $database;

    public function __construct()
    {
        $this->database = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'codelex',
            'server' => 'localhost',
            'username' => 'root',
            'password' => ''
        ]);
    }

    public function getStockData(): StockCollection
    {
        $stockList = new StockCollection();

        $data = $this->database->select('stocks', '*');
        foreach($data as $stock) {
            $stockList->addStock(new Stock(
                $stock['symbol'],
                $stock['price'],
                $stock['amount']
            ));
        }

        return $stockList;
    }


}