<?php

require '../vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Command\VendingMachineCommand;

$application = new Application();
$application->add(new VendingMachineCommand());
$application->run();