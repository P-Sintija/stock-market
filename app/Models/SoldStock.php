<?php

namespace App\Models;

class SoldStock
{
    private string $symbol;
    private int $purchasePrice;
    private int $amount;
    private int $soldPrice;
    private int $benefit;

    public function __construct(
        string $symbol,
        int $purchasePrice,
        int $amount,
        int $soldPrice,
        int $benefit
    )
    {
        $this->symbol = $symbol;
        $this->purchasePrice = $purchasePrice;
        $this->amount = $amount;
        $this->soldPrice = $soldPrice;
        $this->benefit = $benefit;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getPurchasePrice(): int
    {
        return $this->purchasePrice;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getSoldPrice(): int
    {
        return $this->soldPrice;
    }

    public function getBenefit(): ?int
    {
        return $this->benefit;
    }

}