<?php

namespace App\Repositories;


use App\Models\SoldStock;
use App\Models\SoldStockCollection;
use Medoo\Medoo;

class MySQLSoldRepository implements SoldRepository
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

    public function getStockData(): SoldStockCollection
    {
        $stockList = new SoldStockCollection();
        $data = $this->database->select('soldStocks', '*');
        if ($data) {
            foreach ($data as $sold) {
                $stockList->addSold(new SoldStock(
                    $sold['symbol'],
                    $sold['purchasePrice'],
                    $sold['amount'],
                    $sold['soldPrice'],
                    $sold['benefit']
                ));
            }
        }
        return $stockList;
    }

    public function insertSell(SoldStock $stock): void
    {
        $this->database->insert('soldStocks', [
            'symbol' => $stock->getSymbol(),
            'purchasePrice' => $stock->getPurchasePrice(),
            'amount' => $stock->getAmount(),
            'soldPrice' => $stock->getSoldPrice(),
            'benefit' => $stock->getBenefit()
        ]);
    }

}