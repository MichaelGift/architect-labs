<?php

namespace src\interfaces;

interface OfferStrategy {
    public function apply(array $items, array $catalog): float;
}