<?php
namespace App\Models;

class Wallet
{
    private float $budget = 0;

    public function setBudget(int $money): void
    {
        $this->budget = $money;
    }

    public function getBudget(): int
    {
        return $this->budget;
    }
}