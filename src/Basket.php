<?php

namespace src;

use src\contexts\DeliveryContext;
use src\contexts\OfferContext;

class Basket {
    private $catalog;
    private $items = [];
    private $deliveryContext;
    private $offerContext;

    public function __construct(array $catalog, DeliveryContext $deliveryContext, OfferContext $offerContext) {
        $this->catalog = $catalog;
        $this->deliveryContext = $deliveryContext;
        $this->offerContext = $offerContext;
    }

    public function addItem(string $code): void {
        if (array_key_exists($code, $this->catalog)) {
            $this->items[] = $code;
        } else {
            throw new InvalidArgumentException("Item code not found in catalog.");
        }
    }

    public function total(): float {
        $subtotal = array_reduce($this->items, function($carry, $code) {
            return $carry + $this->catalog[$code];
        }, 0.0);

        $totalDiscount = 0.0;
        $totalDiscount += $this->offerContext->applyOffer($this->items, $this->catalog);

        $deliveryFee = $this->deliveryContext->getDeliveryCost($subtotal - $totalDiscount);

        $result = $subtotal - $totalDiscount + $deliveryFee;
        return floor($result * 100) / 100;
    }
};
