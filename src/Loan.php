<?php
namespace App;

use DateTime;

class Loan{
    private $startDate;
    private $endDate;
    
    private $tranches = [];

    public function __construct($startDate, $endDate){
        $this->startDate = new DateTime($startDate);
        $this->endDate = new DateTime($endDate);
    }

    public function addTranches($tranche){
        $this->tranches[] = $tranche;
    }

    public function getTranches(){
        return $this->tranches;
    }
    public function calculateInterest($date){
        
        $date = new DateTime($date);
        $results = [];

        foreach($this->tranches as $tranche){
            $investors = $tranche->getInvestors();
            foreach($investors as $investor){
                $investedDays = $investor->getInvestedDays($this->startDate, $date);
                $interest = $investor->calculateInterest($tranche->getMonthlyInterestRate(), $investedDays);
                $results[$investor->getName()] = $interest;
            }
        }
        return $results;
    }
}