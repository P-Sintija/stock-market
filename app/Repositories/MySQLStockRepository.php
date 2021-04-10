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

        $data = $this->database->select('stock1234', '*');

        if($data) {
            foreach ($data as $stock) {
                $stockList->addStock(new Stock(
                    $stock['symbol'],
                    $stock['price'] ,
                    $stock['amount'],
                    $stock['status'],
                    $stock['id'],
                    $stock['benefit']
                ));
            }
        }

        return $stockList;
    }

    public function insertPurchase(Stock $stock): void
    {

        $this->database->insert('stock1234', [
            'symbol' => $stock->getSymbol(),
            'price' => $stock->getPrice(),
            'amount' => $stock->getAmount(),
            'status' => 'active'
        ]);
    }

    public function searchStock(int $id): Stock
    {
        $data = $this->database->select('stock1234','*',['id'=> $id]);
        return new Stock(
            $data[0]['symbol'],
            $data[0]['price'],
            $data[0]['amount'],
            $data[0]['status'],
            $data[0]['id'],
            $data[0]['benefit']
        );
    }

    public function edit(Stock $stock, int $currentPrice): void
    {
        $where = ['id' => $stock->getId()];

        $this->database->update('stock1234', [
            'symbol' => $stock->getSymbol(),
            'price' => $stock->getPrice(),
            'amount' => $stock->getAmount(),
            'status' => 'sold',
            'id' => $stock->getId(),
            'benefit' => ($currentPrice - $stock->getPrice()) * $stock->getAmount()

        ], $where);
    }
}