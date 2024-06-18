<?php
namespace App;
class Investor{

    private $name;
    private $balance;
    private $investments = [];

    public function __construct($name, $balance){
        $this->name = $name;
        $this->balance = $balance;
    }

    public function getBalance(){
        return $this->balance;
    }

    public function invest($amount, $tranche, $date){
        $this->balance -= $amount;
        $this->investments[] = new Investment($amount, $tranche, $date);
    }

    public function getInvestedDays($loanStartDate, $date){
        $totalDays = 0;

        foreach($this->investments as $investment){
            $totalDays += $investment->getInvestedDays($loanStartDate, $date);
        }
        return $totalDays;
    }

    public function getName(){
        return $this->name;
    }

    public function calculateInterest($monthlyInterestRate, $investedDays){
        $dailyInterestRate = $monthlyInterestRate / 30;
        $totalInterest = 0;
        foreach($this->investments as $investment){
            $totalInterest += $investment->calculateInterest($dailyInterestRate, $investedDays);
        }

        return $totalInterest;
    }
}