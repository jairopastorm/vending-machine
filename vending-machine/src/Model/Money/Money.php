<?php

namespace App\Model\Money;

abstract class Money
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getDisplayValue(): string
    {
        return $this->value;
    }
}