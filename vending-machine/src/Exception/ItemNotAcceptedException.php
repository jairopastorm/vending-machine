<?php

namespace App\Exception;

use Throwable;

class ItemNotAcceptedException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        return parent::__construct("Please, insert only valid items (Water, Juice, Soda)");
    }
}