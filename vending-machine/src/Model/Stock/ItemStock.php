<?php

namespace App\Model\Stock;

class ItemStock
{
    public static function get(): array
    {
        return [
            new Water(),
            new Water(),
            new Juice(),
            new Juice(),
            new Juice(),
            new Juice(),
            new Soda(),
            new Soda(),
            new Soda(),
            new Soda(),
            new Soda()
        ];
    }
}
