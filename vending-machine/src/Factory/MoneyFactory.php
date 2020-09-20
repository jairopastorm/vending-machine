<?php

namespace App\Factory;

use App\Model\Money\Coin;
use App\Model\Money\Money;
use App\Exception\CoinNotAcceptedException;

class MoneyFactory
{
    const ACCEPTED_COINS = [0.05, 0.10, 0.25, 1];

    public function createMoney($amount): Money
    {
        if (in_array($amount, self::ACCEPTED_COINS)) {
            return new Coin($amount);
        }
        throw new CoinNotAcceptedException();
    }
}