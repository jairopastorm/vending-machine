<?php

require __DIR__.'/../vendor/autoload.php';

use App\Factory\ActionFactory;
use App\Factory\MoneyFactory;
use App\UseCase\VendingMachineBasic;
use Symfony\Component\Console\Application;
use App\Command\VendingMachineCommand;

$application = new Application();
$vendingMachineUseCase = new VendingMachineBasic(new MoneyFactory(), new ActionFactory());
$application->add(new VendingMachineCommand($vendingMachineUseCase));
$application->run();