<?php

namespace App\Model\VendingMachine\Behavior;

class VendingProvision implements VendingMachineBehaviorInterface
{
    public function execute(): string
    {
        return "SERVICE";
    }
}