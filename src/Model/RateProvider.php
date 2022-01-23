<?php

namespace App\Model;

use Brick\Math\RoundingMode;

class RateProvider
{
    public function __construct(private RateKeeperCollection $collection) {}

    public function get(string $base, string $quote): Rate
    {
        $rateKeeper = $this->collection->last();

        $rate = $rateKeeper->getRate($base)->dividedBy($rateKeeper->getRate($quote), 10, RoundingMode::DOWN);

        return new Rate($base, $quote, $rate);
    }
}
