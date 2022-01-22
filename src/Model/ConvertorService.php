<?php

namespace App\Model;

use Brick\Math\BigDecimal;

class ConvertorService
{
    public function __construct(
        private RateBundleCollection $collection,
        private CalculatorStrategy $strategy
    ) {
    }

    public function process(string $base, string $quote, BigDecimal $amount): BigDecimal
    {
        $rateBundle = $this->collection->last();

        return $this->strategy->calculate(
            $rateBundle->getRate($base),
            $rateBundle->getRate($quote),
            $amount
        );
    }
}
