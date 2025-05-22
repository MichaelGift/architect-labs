<?php

namespace src\strategies;

use src\interfaces\DeliveryStrategy;

class TieredDeliveryStrategy implements DeliveryStrategy {
    private $rules;

    public function __construct(array $rules) {
        $this->rules = $rules;
    }

    public function calculateDeliveryCost(float $orderTotal): float {
        foreach ($this->rules as $rule) {
            if ($orderTotal >= $rule['min']) {
                return $rule['fee'];
            }
        }
        return 0;
    }
}