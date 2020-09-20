<?php

namespace App\Exception;

use Throwable;

class InsufficientRestToReturnException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        return parent::__construct("Sorry, the machine has no sufficient money to return your rest.");
    }
}