<?php
namespace App;

use Exception;
class Tranche{

    private $name;
    private $monthlyInterestRate;
    private $maxAmount;
    private $currentAmount = 0;
    private $investors = [];

    public function __construct($name, $monthlyInterestRate, $maxAmount){
        $this->name = $name;
        $this->monthlyInterestRate = $monthlyInterestRate;
        $this->maxAmount = $maxAmount;
    }

    public function invest($investor, $amount, $date){
        if($this->currentAmount + $amount > $this->maxAmount){
            throw new Exception("Maximum amount for tranche $this->name exceeded");
        }

        if($investor->getBalance() < $amount){
            throw new Exception("Investor does not have enough money in the wallet");
        }

        $investor->invest($amount, $this, $date);
        $this->currentAmount += $amount;
        $this->investors[] = $investor;
    }

    public function getInvestors(){
        return $this->investors;
    }

    public function getMonthlyInterestRate(){
        return $this->monthlyInterestRate;
    }
}