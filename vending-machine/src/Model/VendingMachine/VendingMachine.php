<?php

namespace App\Model\VendingMachine;

use App\Exception\ActionNotConfiguredException;
use App\Model\Money\MoneyManager;
use App\Model\Stock\ItemManager;
use App\Model\VendingMachine\Behavior\VendingMachineBehaviorInterface;

class VendingMachine implements VendingMachineInterface
{
    private $itemManager;
    private $moneyManager;
    private $actionBehavior;

    public function __construct(ItemManager $itemManager, MoneyManager $moneyManager)
    {
        $this->itemManager = $itemManager;
        $this->moneyManager = $moneyManager;
    }
    public function getItemManager(): ItemManager
    {
        return $this->itemManager;
    }

    public function getMoneyManager(): MoneyManager
    {
        return $this->moneyManager;
    }

    public function insertMoney(array $insertedMoney): void
    {
        foreach ($insertedMoney as $money) {
            $this->moneyManager->insertMoney($money);
        }
    }

    public function setActionBehavior(VendingMachineBehaviorInterface $action): void
    {
        $this->actionBehavior = $action;
    }

    public function operate(): string
    {
        if (empty($this->actionBehavior)) {
            throw new ActionNotConfiguredException();
        }
        return $this->actionBehavior->execute($this);
    }
}