<?php
use PHPUnit\Framework\TestCase;
use src\strategies\TieredDeliveryStrategy;

class TieredDeliveryStrategyTest extends TestCase
{
    public function testReturnsCorrectFeeForSingleRule()
    {
        $rules = [
            ['min' => 0, 'fee' => 5.0],
        ];
        $strategy = new TieredDeliveryStrategy($rules);
        $this->assertEquals(5.0, $strategy->calculateDeliveryCost(10));
    }

    public function testReturnsCorrectFeeForMultipleRules()
    {
        $rules = [
            ['min' => 100, 'fee' => 0.0],
            ['min' => 50, 'fee' => 2.5],
            ['min' => 0, 'fee' => 5.0],
        ];
        $strategy = new TieredDeliveryStrategy($rules);

        $this->assertEquals(0.0, $strategy->calculateDeliveryCost(120));
        $this->assertEquals(2.5, $strategy->calculateDeliveryCost(70));
        $this->assertEquals(5.0, $strategy->calculateDeliveryCost(10));
    }

    public function testReturnsZeroWhenNoRulesMatch()
    {
        $rules = [
            ['min' => 50, 'fee' => 2.5],
        ];
        $strategy = new TieredDeliveryStrategy($rules);
        $this->assertEquals(0.0, $strategy->calculateDeliveryCost(10));
    }

    public function testReturnsFirstMatchingRule()
    {
        $rules = [
            ['min' => 100, 'fee' => 0.0],
            ['min' => 50, 'fee' => 2.5],
            ['min' => 0, 'fee' => 5.0],
        ];
        $strategy = new TieredDeliveryStrategy($rules);

        // Should match the first rule where orderTotal >= min
        $this->assertEquals(2.5, $strategy->calculateDeliveryCost(60));
    }
}