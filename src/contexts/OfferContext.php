<?php

namespace src\contexts;

use src\interfaces\OfferStrategy;

class OfferContext {
    private $offerStrategy;

    public function __construct(OfferStrategy $strategy) {
        $this->offerStrategy = $strategy;
    }

    public function setStrategy(OfferStrategy $strategy): void {
        $this->offerStrategy = $strategy;
    }
    
    public function applyOffer(array $items, array $catalog): float {
        return $this->offerStrategy->apply($items, $catalog);
    }
}