<?php

namespace App\Models;

class Stock
{
    private string $symbol;
    private int $price;
    private int $amount;
    private string $status;
    private ?int $id;
    private ?int $benefit;

    public function __construct(
        string $symbol,
        int $price,
        int $amount,
        string $status,
        int $id = null,
        int $benefit = null
    )
    {
        $this->symbol = $symbol;
        $this->price = $price;
        $this->amount = $amount;
        $this->status = $status;
        $this->id = $id;
        $this->benefit = $benefit;
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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBenefit(): ?int
    {
        return $this->benefit;
    }
}