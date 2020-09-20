<?php

namespace App\Model\Stock;

use App\Exception\ItemNotAcceptedException;
use App\Exception\ItemSoldoutException;
use App\Factory\ItemFactory;

class ItemManager
{
    private $availableItems;
    private $itemFactory;

    public static function getInstance()
    {
        return new self(new ItemFactory());
    }

    public function count()
    {
        return $this->availableItems;
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

    public function checkItemExists($itemName): void
    {
        if (!in_array($itemName, ItemFactory::ACCEPTED_ITEMS)) {
            throw new ItemNotAcceptedException();
        }
    }

    public function addItemToStock(Item $item): void
    {
        $this->availableItems[] = $item;
    }

    public function createItem($itemName): Item
    {
        return $this->itemFactory->createItem($itemName);
    }
}
