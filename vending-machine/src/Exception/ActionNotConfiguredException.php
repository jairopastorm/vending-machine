<?php

namespace App\Exception;

use Throwable;

class ActionNotConfiguredException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        return parent::__construct("The Vending Machine behavior hasn't been configured!");
    }
}