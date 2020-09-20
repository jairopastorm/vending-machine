<?php

namespace App\Model\VendingMachine\Behavior;

use App\Model\Money\MoneyManager;
use App\Model\Stock\Item;
use App\Model\Stock\ItemManager;

class GetItem implements VendingMachineBehaviorInterface
{
    private $itemManager;
    private $moneyManager;
    private $actionArgs;

    public function __construct(ItemManager $itemManager, MoneyManager $moneyManager, string $actionArgs)
    {
        $this->itemManager = $itemManager;
        $this->moneyManager = $moneyManager;
        $this->actionArgs = $actionArgs;
    }

    public function execute(): string
    {
        $item = $this->itemManager->createItem($this->parseItem($this->actionArgs));
        $rest = $this->moneyManager->makePayment($item->getPrice());
        $this->itemManager->substractItemFromStock($item);
        return $this->getResponse($item, $rest);
    }

    private function parseItem(string $action): string
    {
        $itemName = '';
        $explodedItemAction = explode(' ', $action);
        if (count($explodedItemAction) > 1) {
            $itemName = strtolower(trim($explodedItemAction[1]));
        }
        return $itemName;
    }

    private function getResponse(Item $item, array $rest)
    {
        $response = strtoupper($item->getName());
        foreach ($rest as $moneyRest) {
            $response .= ' ' . $moneyRest->getValue();
        }
        return $response;
    }
}