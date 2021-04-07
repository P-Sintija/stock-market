<?php
namespace App\Models;

class Stock
{
    private string $symbol;
    private int $price;
    private int $amount;
    public function __construct(string $symbol, int $price, int $amount)
    {
        $this->symbol = $symbol;
        $this->price = $price;
        $this->amount = $amount;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

}