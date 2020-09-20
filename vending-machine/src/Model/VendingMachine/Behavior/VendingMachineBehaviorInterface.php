<?php

namespace App\Model\VendingMachine\Behavior;

interface VendingMachineBehaviorInterface
{
    public function execute(): string;
}