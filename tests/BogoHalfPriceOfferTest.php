<?php
use PHPUnit\Framework\TestCase;
use src\strategies\BogoHalfPriceOffer;

class BogoHalfPriceOfferTest extends TestCase
{
    public function testApplyReturnsZeroWhenNoMatchingItems()
    {
        $offer = new BogoHalfPriceOffer('A');
        $items = ['B', 'C', 'D'];
        $catalog = ['A' => 10.0, 'B' => 5.0, 'C' => 7.0, 'D' => 3.0];

        $this->assertEquals(0.0, $offer->apply($items, $catalog));
    }

    public function testApplyReturnsHalfPriceForOnePair()
    {
        $offer = new BogoHalfPriceOffer('A');
        $items = ['A', 'A'];
        $catalog = ['A' => 10.0];

        $this->assertEquals(5.0, $offer->apply($items, $catalog));
    }

    public function testApplyReturnsHalfPriceForMultiplePairs()
    {
        $offer = new BogoHalfPriceOffer('A');
        $items = ['A', 'A', 'A', 'A'];
        $catalog = ['A' => 10.0];

        $this->assertEquals(10.0, $offer->apply($items, $catalog));
    }

    public function testApplyIgnoresOddItem()
    {
        $offer = new BogoHalfPriceOffer('A');
        $items = ['A', 'A', 'A'];
        $catalog = ['A' => 10.0];

        $this->assertEquals(5.0, $offer->apply($items, $catalog));
    }

    public function testApplyWithMixedItems()
    {
        $offer = new BogoHalfPriceOffer('A');
        $items = ['A', 'B', 'A', 'C', 'A'];
        $catalog = ['A' => 8.0, 'B' => 5.0, 'C' => 3.0];

        // 3 'A's: only one pair, so 8.0 * 0.5 = 4.0
        $this->assertEquals(4.0, $offer->apply($items, $catalog));
    }
}