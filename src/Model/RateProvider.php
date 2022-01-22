<?php

namespace App\Model;

use Brick\Math\RoundingMode;

class RateProvider
{
    public function __construct(private RateHistoryCollection $collection) {}

    public function get(string $base, string $quote): Rate
    {
        $rateHistory = $this->collection->last();

        $rate = $rateHistory->getRate($base)->dividedBy($rateHistory->getRate($quote), 10, RoundingMode::DOWN);

        return new Rate($base, $quote, $rate);
    }
}
