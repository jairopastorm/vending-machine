<?php

namespace App\Command;

use App\UseCase\VendingMachineUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class VendingMachineCommand extends Command
{
    private $questionHelper;
    private $vendingMachineUseCase;

    public function __construct(VendingMachineUseCase $vendingMachineUseCase)
    {
        $this->vendingMachineUseCase = $vendingMachineUseCase;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('app:vending-machine')
            ->setDescription('This command allows you to interact with the Vending Machine application');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->printWelcomeMessage($output);
        do {
            try {
                $inputMoney = $this->askInfo($input, $output, 'Please enter money separated by comma (e.g. 0.10, 0.25): ');
                $inputAction = $this->askInfo($input, $output, 'Please enter desired action (e.g. GET Water, RETURN-COIN): ');
                $response = $this->vendingMachineUseCase->execute($inputMoney, $inputAction);
                $this->printResponse($output, $response);
            } catch(\Exception $e) {
                $this->printError($output, $e->getMessage());
                $this->printResponse($output, 'RETURNING INSERTED MONEY: ' . $inputMoney);
                exit;
            }
        } while ($this->userWantsToRepeat($input, $output));
        return Command::SUCCESS;
    }

    private function printWelcomeMessage(OutputInterface $output): void
    {
        $output->writeln('');
        $output->writeln('<fg=white;bg=cyan>== WELCOME TO VENDING MACHINE APP ==</>');
        $output->writeln('');
    }

    private function askInfo(InputInterface $input, OutputInterface $output, string $message): string
    {
        do {
            $userInput = $this->getQuestionHelper()->ask($input, $output, new Question($message));
        } while (empty(trim($userInput)));
        return $userInput;
    }

    private function getQuestionHelper(): QuestionHelper
    {
        if (is_null($this->questionHelper)) {
            $this->questionHelper = $this->getHelper('question');
        }
        return $this->questionHelper;
    }

    private function printResponse(OutputInterface $output, string $response): void
    {
        $output->writeln('');
        $output->writeln('<info>-> ' . $response . '</info>');
        $output->writeln('');
    }

    private function printError(OutputInterface $output, string $message): void
    {
        $output->writeln('');
        $output->writeln('<error>' . $message . '</error>');
        $output->writeln('');
    }

    private function userWantsToRepeat(InputInterface $input, OutputInterface $output): bool
    {
        $userInput = $this->askInfo($input, $output, '--> Do you want to do another operation? (y|n) ');
        return $userInput == 'y';
    }

}