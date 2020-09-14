<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class VendingMachineCommand extends Command
{
    protected function configure()
    {
        $this->setName('vending-machine')
            ->setDescription('This command allows you to interact with the Vending Machine application');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        return 0;
    }
}