<?php

namespace src\contexts;
use src\interfaces\DeliveryStrategy;

class DeliveryContext {
    private $deliveryStrategy;

    public function __construct(DeliveryStrategy $strategy) {
        $this->deliveryStrategy = $strategy;
    }

    public function setStrategy(DeliveryStrategy $strategy) {
        $this->deliveryStrategy = $strategy;
    }

    public function getDeliveryCost(float $subtotal): float {
        return $this->deliveryStrategy->calculateDeliveryCost($subtotal);
    }
}
