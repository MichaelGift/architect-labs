<?php

namespace src\interfaces;
 
interface DeliveryStrategy {
    public function calculateDeliveryCost(float $total): float;
}