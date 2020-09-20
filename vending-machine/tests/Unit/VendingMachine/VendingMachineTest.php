<?php

namespace App\Tests\Unit\VendingMachine;

use App\Model\Money\MoneyManager;
use App\Model\Stock\ItemManager;
use App\Model\VendingMachine\Behavior\GetItem;
use App\Model\VendingMachine\Behavior\ReturnMoney;
use App\Model\VendingMachine\VendingMachine;
use PHPUnit\Framework\TestCase;

class VendingMachineTest extends TestCase
{
    private $itemManager;
    private $moneyManager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->itemManager = $this->getMockBuilder(ItemManager::class)
            ->disableOriginalConstructor()->setMethodsExcept([])->getMock();
        $this->moneyManager = $this->getMockBuilder(MoneyManager::class)
            ->disableOriginalConstructor()->setMethodsExcept([])->getMock();
    }

    public function testOperateGetItem()
    {
        $getItemBehavior = $this->getMockBuilder(GetItem::class)
            ->disableOriginalConstructor()->setMethodsExcept([])->getMock();
        $getItemBehavior->expects($this->once())->method('execute')->willReturn('actionResponse');

        $this->assertVendingMachineOperate($getItemBehavior);
    }

    public function testOperateReturnMoney()
    {
        $returnMoneyBehavior = $this->getMockBuilder(ReturnMoney::class)
            ->disableOriginalConstructor()->setMethodsExcept([])->getMock();
        $returnMoneyBehavior->expects($this->once())->method('execute')->willReturn('actionResponse');

        $this->assertVendingMachineOperate($returnMoneyBehavior);
    }

    private function assertVendingMachineOperate($behavior)
    {
        $vendingMachine = new VendingMachine($this->itemManager, $this->moneyManager);
        $vendingMachine->setActionBehavior($behavior);

        $this->assertEquals('actionResponse', $vendingMachine->operate());
    }

}
