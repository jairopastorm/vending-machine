<?php

namespace App\Model\Stock;

abstract class Item
{
    protected $name;
    protected $price;

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isEqual($name): bool
    {
        return $this->name == $name;
    }
}
