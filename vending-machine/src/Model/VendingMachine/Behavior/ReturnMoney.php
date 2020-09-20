<?php

namespace App\Model\VendingMachine\Behavior;

use App\Model\Money\MoneyManager;

class ReturnMoney implements VendingMachineBehaviorInterface
{
    private $moneyManager;

    public function __construct(MoneyManager $moneyManager)
    {
        $this->moneyManager = $moneyManager;
    }

    public function execute(): string
    {
        return $this->moneyManager->returnCustomerMoney();
    }
}