<?php

namespace App\Models;

class Stock
{
    private string $symbol;
    private int $price;
    private int $amount;
    private ?int $id;
    private string $date;

    public function __construct(
        string $symbol,
        int $price,
        int $amount,
        string $date,
        int $id = null
    )
    {
        $this->symbol = $symbol;
        $this->price = $price;
        $this->amount = $amount;
        $this->id = $id;
        $this->date = $date;
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): string
    {
        return $this->date;
    }

}