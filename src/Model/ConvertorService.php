<?php

namespace App\Model;

use Brick\Money\Money;

class ConvertorService
{
    public function __construct(
        private RateProvider $rateProvider,
        private CalculatorStrategy $strategy
    ) {
    }

    public function convert(Money $money, string $quoteCurrency): Money
    {
        if ($money->getCurrency()->getCurrencyCode() === $quoteCurrency) {
            return $money;
        }

        $rate = $this->rateProvider->get($money->getCurrency()->getCurrencyCode(), $quoteCurrency);

        return $this->strategy->calculate($rate, $money);
    }
}
