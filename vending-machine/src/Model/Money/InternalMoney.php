<?php

namespace App\Model\Money;

class InternalMoney
{
    public static function get(): array
    {
        return [
            new Coin(0.05),
            new Coin(0.05),
            new Coin(0.05),
            new Coin(0.05),
            new Coin(0.05),
            new Coin(0.10),
            new Coin(0.10),
            new Coin(0.10),
            new Coin(0.10),
            new Coin(0.25),
            new Coin(0.25),
            new Coin(0.25),
            new Coin(0.25),
            new Coin(0.25),
            new Coin(0.25),
            new Coin(0.25),
            new Coin(1),
            new Coin(1),
            new Coin(1),
            new Coin(1),
            new Coin(1),
            new Coin(1),
            new Coin(1)
        ];
    }
}
