<?php

namespace App\UseCase;

interface VendingMachineUseCase
{
    public function execute(string $inputMoney, string $inputAction);
}