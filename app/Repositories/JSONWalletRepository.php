<?php

namespace App\Repositories;

use App\Models\Wallet;

class JSONWalletRepository implements WalletRepository
{
    public function getWallet(): Wallet
    {
        $readJSON = file_get_contents(__DIR__ . '/../../Storage/wallet.json');
        $file = json_decode($readJSON, true);
        $budget = new Wallet();
        $budget->setBudget((int)$file['budget']);

        return $budget;
    }

    public function remove(int $money): void
    {
        $readJSON = file_get_contents(__DIR__ . '/../../Storage/wallet.json');
        $file = json_decode($readJSON, true);
        $budget = new Wallet();
        $budget->setBudget((int)$file['budget'] - $money);
        $file['budget'] = $budget->getBudget();
        $modifiedJSON = json_encode($file);
        file_put_contents(__DIR__ . '/../../Storage/wallet.json', $modifiedJSON);
    }

    public function add(int $money): void
    {
        $readJSON = file_get_contents(__DIR__ . '/../../Storage/wallet.json');
        $file = json_decode($readJSON, true);
        $budget = new Wallet();
        $budget->setBudget((int)$file['budget'] + $money);
        $file['budget'] = $budget->getBudget();
        $modifiedJSON = json_encode($file);
        file_put_contents(__DIR__ . '/../../Storage/wallet.json', $modifiedJSON);
    }

}