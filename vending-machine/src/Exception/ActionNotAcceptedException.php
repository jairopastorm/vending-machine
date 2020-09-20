<?php

namespace App\Exception;

use Throwable;

class ActionNotAcceptedException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        return parent::__construct("Please, insert only valid actions (GET-XXX, RETURN-COIN, SERVICE)");
    }
}