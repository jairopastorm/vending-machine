<?php

namespace App\Model\VendingMachine\Behavior;

class VendingProvision implements VendingMachineBehaviorInterface
{
    public function execute()
    {
        return "SERVICE";
    }
}