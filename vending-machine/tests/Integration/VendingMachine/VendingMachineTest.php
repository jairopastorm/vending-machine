<?php

namespace App\Tests\Integration\VendingMachine;

use App\Factory\ActionFactory;
use App\Factory\MoneyFactory;
use App\Model\Money\MoneyManager;
use App\Model\Stock\ItemManager;
use App\Model\VendingMachine\VendingMachine;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class VendingMachineTest extends KernelTestCase
{
    public function testOperateGetItem()
    {
        $vendingMachine = new VendingMachine(
            ItemManager::getInstance(),
            MoneyManager::getInstance()
        );

        $vendingMachine->setActionBehavior(
            (new ActionFactory())->createAction($vendingMachine, 'GET Water')
        );
        $vendingMachine->insertMoney(
            [(new MoneyFactory())->createMoney(1)]
        );

        $this->assertEquals('WATER 0.25 0.1', $vendingMachine->operate());
    }

    public function testOperateReturnMoney()
    {
        $vendingMachine = new VendingMachine(
            ItemManager::getInstance(),
            MoneyManager::getInstance()
        );

        $vendingMachine->setActionBehavior(
            (new ActionFactory())->createAction($vendingMachine, 'RETURN-COIN')
        );
        $vendingMachine->insertMoney(
            [(new MoneyFactory())->createMoney(1), (new MoneyFactory())->createMoney(0.25)]
        );

        $this->assertEquals('1 0.25 ', $vendingMachine->operate());
    }
}
