<?php

namespace App\Model;

use Brick\Math\RoundingMode;
use Brick\Money\Money;

class CalculateStrategy
{
    public function calculate(Rate $rate, Money $money): Money
    {
        if ($rate->getBaseCurrency() !== $money->getCurrency()->getCurrencyCode()) {
            throw new \RuntimeException('rate/money inconsistency');
        }

        $amount = $money->multipliedBy($rate->getValue(), RoundingMode::DOWN)->getAmount();

        return Money::of($amount, $rate->getQuoteCurrency());
    }
}
