<?php

use PHPUnit\Framework\TestCase;
use src\strategies\BogoHalfPriceOffer;
use src\strategies\TieredDeliveryStrategy;
use src\contexts\DeliveryContext;
use src\contexts\OfferContext;
use src\Basket;

class BasketTest extends TestCase
{
    private $catalog;
    private $deliveryContext;
    private $offerContext;

    protected function setUp(): void
    {
        $this->catalog = require 'src/data/Widgets.php';
        $deliveryRules = require 'src/data/DeliveryFee.php';

        $bogoStrat = new BogoHalfPriceOffer('R01');
        $deliveryStrat = new TieredDeliveryStrategy($deliveryRules);

        $this->deliveryContext = new DeliveryContext($deliveryStrat);
        $this->offerContext = new OfferContext($bogoStrat);
    }

    public function testAddSingleItem()
    {
        $basket = new Basket($this->catalog, $this->deliveryContext, $this->offerContext);
        $basket->addItem('B01');
        $this->assertEquals(12.9, $basket->total());
    }

    public function testFirstPurchaseCombination() 
    {
        $basket = new Basket($this->catalog, $this->deliveryContext, $this->offerContext);
        $basket->addItem('B01');
        $basket->addItem('G01');
        $this->assertEquals(37.85, $basket->total());
    }

    public function testSecondPurchaseCombination()
    {
        $basket = new Basket($this->catalog, $this->deliveryContext, $this->offerContext);
        $basket->addItem('R01');
        $basket->addItem('R01');
        $this->assertEquals(54.37, $basket->total());  
    }

    public function testThirdPurchaseCombination()
    {
        $basket = new Basket($this->catalog, $this->deliveryContext, $this->offerContext);
        $basket->addItem('R01');
        $basket->addItem('G01');
        $this->assertEquals(60.85, $basket->total());  
    }

    public function testFourthPurchaseCombination()
    {
        $basket = new Basket($this->catalog, $this->deliveryContext, $this->offerContext);
        $basket->addItem('B01');
        $basket->addItem('B01');
        $basket->addItem('R01');
        $basket->addItem('R01');
        $basket->addItem('R01');
        $this->assertEquals(98.27, $basket->total()); 
    }
}