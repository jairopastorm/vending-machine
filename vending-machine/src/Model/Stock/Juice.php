<?php

namespace App\Model\Stock;

class Juice extends Item
{
    public function __construct()
    {
        $this->price = 1.00;
        $this->name = 'juice';
    }
}
