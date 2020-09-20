<?php

namespace App\Factory;

use App\Exception\ItemNotAcceptedException;
use App\Model\Stock\Item;
use App\Model\Stock\Juice;
use App\Model\Stock\Soda;
use App\Model\Stock\Water;

class ItemFactory
{
    public function createItem(string $itemName): Item
    {
        switch ($itemName) {
            case 'water':
                return new Water();
            case 'juice':
                return new Juice();
            case 'soda':
                return new Soda();
            default:
                throw new ItemNotAcceptedException();
        }
    }
}