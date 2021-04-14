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
        if ($data) {
            foreach ($data as $stock) {
                $stockList->addStock(new Stock(
                    $stock['symbol'],
                    $stock['price'],
                    $stock['amount'],
                    $stock['date'],
                    $stock['id']
                ));
            }
        }
        return $stockList;
    }

    public function insertPurchase(Stock $stock): void
    {

        $this->database->insert('stocks', [
            'symbol' => $stock->getSymbol(),
            'price' => $stock->getPrice(),
            'amount' => $stock->getAmount(),
            'date' => $stock->getDate()
        ]);
    }

    public function searchStock(int $id): Stock
    {
        $data = $this->database->select('stocks', '*', ['id' => $id]);
        return new Stock(
            $data[0]['symbol'],
            $data[0]['price'],
            $data[0]['amount'],
            $data[0]['date'],
            $data[0]['id']
        );
    }

    public function edit(Stock $stock, string $key, int $value): void
    {
        $where = ['id' => $stock->getId()];
        $this->database->update('stocks', [
            $key => $value
        ], $where);
    }

    public function delete(Stock $stock): void
    {
        $where = ['id' => $stock->getId()];
        $this->database->delete('stocks', $where);
    }
}