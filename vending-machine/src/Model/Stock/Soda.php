<?php

namespace App\Model\Stock;

class Soda extends Item
{
    public function __construct()
    {
        $this->price = 1.50;
        $this->name = 'soda';
    }
}
