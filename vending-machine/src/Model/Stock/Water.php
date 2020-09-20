<?php

namespace App\Model\Stock;

class Water extends Item
{
    public function __construct()
    {
        $this->price = 0.65;
        $this->name = 'water';
    }
}
