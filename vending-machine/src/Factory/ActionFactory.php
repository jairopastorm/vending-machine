<?php

namespace App\Factory;

use App\Model\VendingMachine\Behavior\GetItem;
use App\Model\VendingMachine\Behavior\ReturnMoney;
use App\Model\VendingMachine\Behavior\VendingMachineBehaviorInterface;
use App\Model\VendingMachine\Behavior\VendingProvision;
use App\Exception\ActionNotAcceptedException;
use App\Model\VendingMachine\VendingMachine;

class ActionFactory
{
    public function createAction(VendingMachine $vendingMachine, string $actionArgs): VendingMachineBehaviorInterface
    {
        switch ($actionArgs) {
            case $this->isGetProduct($actionArgs):
                return new GetItem($vendingMachine->getItemManager(), $vendingMachine->getMoneyManager(), $actionArgs);
            case 'RETURN-COIN':
                return new ReturnMoney($vendingMachine->getMoneyManager());
            case 'SERVICE':
                return new VendingProvision();
            default:
                throw new ActionNotAcceptedException();
        }
    }

    private function isGetProduct($action): bool
    {
        return strtoupper(substr(trim($action), 0, 3)) == "GET";
    }
}