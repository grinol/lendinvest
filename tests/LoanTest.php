<?php

use PHPUnit\Framework\TestCase;
use App\Loan;
use App\Tranche;
use App\Investor;

class LoanTest extends TestCase {
    public function testScenario() {
        
        $loan = new Loan('2023-10-01', '2023-11-15');
        $trancheA = new Tranche('A', 3, 1000);
        $trancheB = new Tranche('B', 6, 1000);
        $loan->addTranches($trancheA);
        $loan->addTranches($trancheB);

        $investor1 = new Investor('Investor1', 1000);
        $investor2 = new Investor('Investor2', 1000);
        $investor3 = new Investor('Investor3', 1000);
        $investor4 = new Investor('Investor4', 1000);

        $trancheA->invest($investor1, 1000, '2023-10-03');
        $this->expectException(Exception::class);
        $trancheA->invest($investor2, 1, '2023-10-04');
        $trancheB->invest($investor3, 500, '2023-10-10');
        $this->expectException(Exception::class);
        $trancheB->invest($investor4, 1100, '2023-10-25');

        $interests = $loan->calculateInterest('2023-11-01');
        $this->assertEqualsWithDelta(28.06, $interests['Investor 1'], 0.01);
        $this->assertEqualsWithDelta(21.29, $interests['Investor 3'], 0.01);
    }
}
