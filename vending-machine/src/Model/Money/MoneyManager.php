<?php

namespace App\Model\Money;

use App\Exception\InsufficientFundsException;
use App\Exception\InsufficientRestToReturnException;
use App\Factory\MoneyFactory;

class MoneyManager
{
    private $customerBudget;
    private $internalBudget;

    public static function getInstance(): MoneyManager
    {
        return new self();
    }

    public function __construct()
    {
        $this->customerBudget = new Budget();
        $this->internalBudget = new Budget(InternalMoney::get());
    }

    public function insertMoney(Money $money): void
    {
        $this->customerBudget->addMoney($money);
    }

    public function returnCustomerMoney()
    {
        $moneyValues = "RETURNED MONEY: ";
        foreach ($this->customerBudget->getMoney() as $money) {
            $moneyValues .= (string)$money->getDisplayValue() . ' ';
        }
        $this->customerBudget->emptyMoney();
        return $moneyValues;
    }

    public function getCustomerAvailableAmount(): float
    {
        return $this->customerBudget->getTotalAmount();
    }

    public function makePayment($amount): array
    {
        $this->checkSufficientFunds($amount);
        $rest = $this->substractAmountAndReturnRest($amount);
        return $rest;
    }

    private  function checkSufficientFunds($amount): void
    {
        if ($this->customerBudget->getTotalAmount() < $amount) {
            throw new InsufficientFundsException(
                sprintf("Item price: %.2f, Available amount: %.2f", $amount, $this->getCustomerAvailableAmount())
            );
        }
    }

    private function substractAmountAndReturnRest($amount): array
    {
        $moneyToReturn = [];
        $remainingRest = $this->customerBudget->getTotalAmount() - $amount;
        // First, try to collect the rest from customer's inserted money
        if ($this->stillRemainingRest($remainingRest)) {
            list($restFromCustomerBudget, $remainingRest) = $this->subtractRestFromBudget($this->customerBudget, $remainingRest);
            $moneyToReturn = array_merge($moneyToReturn, $restFromCustomerBudget);
        }
        // If it's not complete yet, try to collect the remaining rest from internal money
        if ($this->stillRemainingRest($remainingRest)) {
            list($restFromInternalBudget, $remainingRest) = $this->subtractRestFromBudget($this->internalBudget, $remainingRest);
            $moneyToReturn = array_merge($moneyToReturn, $restFromInternalBudget);
        }
        // If there are not sufficient rest, throw exception
        if ($this->stillRemainingRest($remainingRest)) {
            throw new InsufficientRestToReturnException();
        }
        // If there are customer's money that not are used to collect the rest, move it to internal budget
        $this->customerBudget->moveMoneyToBudget($this->internalBudget);
        return $moneyToReturn;
    }

    private function stillRemainingRest(float $remainingRest): bool
    {
        return round($remainingRest, 2) > 0.0;
    }

    private function subtractRestFromBudget(Budget $budget, float $rest): array
    {
        $moneyToReturn = [];
        $availableMoney = $budget->getMoneyOrderDesc();

        foreach ($availableMoney as $pos=>$money) {
            if ($this->moneyValueIsBiggerThanRemainingRest($money, $rest)) {
                continue;
            }
            $moneyToReturn[] = $money;
            $rest = $this->recalculateRemainingRest($rest, $money);
            $this->substractAmountFromAvailableMoney($availableMoney, $pos);
            if ($this->allRestCollected($rest)) {
                break;
            }
        }

        $budget->setMoney($availableMoney);
        return [$moneyToReturn, $rest];
    }

    private function moneyValueIsBiggerThanRemainingRest(Money $money, float $rest): bool
    {
        return round($money->getValue(), 2) > round($rest, 2);
    }

    private function recalculateRemainingRest(float $rest, Money $money): float
    {
        return $rest - $money->getValue();
    }

    private function substractAmountFromAvailableMoney(array &$availableMoney, int $pos): void
    {
        array_splice($availableMoney, $pos, 1);
    }

    private function allRestCollected(float $rest): bool
    {
        return round($rest, 2) <= 0.0;
    }
}
