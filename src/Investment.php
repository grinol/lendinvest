<?php
namespace App;

use DateTime;
class Investment{

    private $amount;
    private $tranche;
    private $date;

    public function __construct($amount, $tranche, $date){
        $this->amount = $amount;
        $this->tranche = $tranche;
        $this->date = new DateTime($date);
    }

    public function getInvestedDays($loanStartDate, $endDate){
        
        if($this->date > $loanStartDate){
            $start = $this->date;
        }else{
            $start = $loanStartDate;
        }

        if($endDate < $this->date){
            $end = $this->date;
        }else{
            $end = $endDate;
        }

        $interval = $start->diff($end);
        return $interval->days;
    }

    public function calculateInterest($dailyInterestRate, $investedDays){
        $interestRate = $dailyInterestRate * $investedDays;
        return ($this->amount * $interestRate) / 100;
    }
}