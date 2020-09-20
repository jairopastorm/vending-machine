<?php

namespace App\Exception;

use Throwable;

class InsufficientFundsException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        return parent::__construct("You have insufficient funds to buy this product (".$message.")");
    }
}