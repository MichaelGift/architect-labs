<?php

namespace src\strategies;

use src\interfaces\OfferStrategy;

class BogoHalfPriceOffer implements OfferStrategy {
    private $productCode;

    public function __construct(string $productCode) {
        $this->productCode = $productCode;
    }

    public function apply(array $items, array $catalog): float {
        $count = 0.0;

        foreach($items as $code) {
            if ($code === $this->productCode) $count++;
        }

        return floor($count / 2) * ($catalog[$this->productCode] * 0.5);
    }
}