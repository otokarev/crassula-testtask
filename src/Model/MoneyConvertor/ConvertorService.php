<?php

namespace App\Model\MoneyConvertor;

use Brick\Math\RoundingMode;
use Brick\Money\Money;

class ConvertorService
{
    public function __construct(private RateCalculateService $service) {}

    public function convert(Money $money, string $quoteCurrency): Money
    {
        if ($money->getCurrency()->getCurrencyCode() === $quoteCurrency) {
            return $money;
        }

        $rate = $this->service->getRateForPair($money->getCurrency()->getCurrencyCode(), $quoteCurrency);

        $amount = $money->multipliedBy($rate, RoundingMode::DOWN)->getAmount();

        return Money::of($amount, $quoteCurrency);
    }
}
