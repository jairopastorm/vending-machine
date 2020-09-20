<?php

namespace App\Model\VendingMachine;

use App\Model\VendingMachine\Behavior\VendingMachineBehaviorInterface;

interface VendingMachineInterface
{
    public function insertMoney(array $insertedMoney): void;
    public function setActionBehavior(VendingMachineBehaviorInterface $action): void;
    public function operate(): string;

}