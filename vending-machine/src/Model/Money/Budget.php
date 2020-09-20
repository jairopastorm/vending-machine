<?php

namespace App\Model\Money;

class Budget
{
    private $money;

    public function __construct(array $money = [])
    {
        $this->money = $money;
    }

    public function addMoney(Money $money): void
    {
        $this->money[] = $money;
    }

    public function getMoney(): array
    {
        return $this->money;
    }

    public function setMoney(array $money): void
    {
        $this->money = $money;
    }

    public function emptyMoney(): void
    {
        $this->money = [];
    }

    public function getTotalAmount(): float
    {
        $amount = 0.0;
        foreach ($this->money as $money) {
            $amount += $money->getValue();
        }
        return $amount;
    }

    public function getMoneyOrderDesc(): array
    {
        $availableMoney = $this->getMoney();
        usort($availableMoney, static function(Money $a, Money $b) { // Order DESC
            return $a->getValue() < $b->getValue();
        });
        return $availableMoney;
    }
}
