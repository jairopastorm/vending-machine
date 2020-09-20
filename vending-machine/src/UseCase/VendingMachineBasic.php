<?php

namespace App\UseCase;

use App\Model\Money\MoneyManager;
use App\Model\Stock\ItemManager;
use App\Model\VendingMachine\VendingMachine;
use App\Factory\ActionFactory;
use App\Factory\MoneyFactory;

class VendingMachineBasic implements VendingMachineUseCase
{
    /**
     * @var VendingMachine $vendingMachine
     */
    private $vendingMachine;
    private $moneyFactory;
    private $actionFactory;

    /**
     * VendingMachineOperate constructor.
     * @param MoneyFactory $moneyFactory
     * @param ActionFactory $actionFactory
     */
    public function __construct(MoneyFactory $moneyFactory, ActionFactory $actionFactory)
    {
        $this->moneyFactory = $moneyFactory;
        $this->actionFactory = $actionFactory;
    }

    /**
     * @param string $inputMoney
     * @param string $inputAction
     */
    public function execute(string $inputMoney, string $inputAction): string
    {
        $this->createVendingMachine();
        $this->configureVendingMachine($inputMoney, $inputAction);
        return $this->vendingMachine->operate();
    }

    private function createVendingMachine()
    {
        if (is_null($this->vendingMachine)) {
            $this->vendingMachine = new VendingMachine(
                ItemManager::getInstance(),
                MoneyManager::getInstance()
            );
        }
    }

    private function configureVendingMachine(string $inputMoney, string $inputAction): void
    {
        $this->vendingMachine->setActionBehavior(
            $this->actionFactory->createAction($this->vendingMachine, $inputAction)
        );
        $this->vendingMachine->insertMoney(
            $this->parseInsertedMoney($inputMoney)
        );
    }

    private function parseInsertedMoney($inputMoney): array
    {
        $insertedMoney = [];
        foreach (explode(',', $inputMoney) as $value) {
            $insertedMoney[] = $this->moneyFactory->createMoney(trim($value));
        }
        return $insertedMoney;
    }
}