<?php

namespace App\Model\Stock;

use App\Exception\ItemSoldoutException;
use App\Factory\ItemFactory;

class ItemManager
{
    private $availableItems;
    private $itemFactory;

    public static function getInstance(): ItemManager
    {
        return new self(new ItemFactory());
    }

    public function __construct(ItemFactory $itemFactory)
    {
        $this->availableItems = ItemStock::get();
        $this->itemFactory = $itemFactory;
    }

    public function substractItemFromStock(Item $selectedItem): void
    {
        foreach ($this->availableItems as $itemPos=>$item) {
            if ($item->isEqual($selectedItem->getName())) {
                array_splice($this->availableItems, $itemPos, 1);
                return;
            }
        }
        throw new ItemSoldoutException();
    }

    public function createItem($itemName): Item
    {
        return $this->itemFactory->createItem($itemName);
    }
}
