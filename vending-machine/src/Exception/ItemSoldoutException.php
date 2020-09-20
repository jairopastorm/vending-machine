<?php

namespace App\Exception;

use Throwable;

class ItemSoldoutException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        return parent::__construct("Sorry, the selected item is soldout!");
    }
}