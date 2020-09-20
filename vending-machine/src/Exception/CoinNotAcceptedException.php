<?php

namespace App\Exception;

use Throwable;

class CoinNotAcceptedException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        return parent::__construct("Please, insert only valid coins (0.05, 0.10, 0.25, 1)");
    }
}