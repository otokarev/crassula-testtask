<?php

namespace App\Model;

use Brick\Math\BigDecimal;

class CalculatorStrategy
{
    public function calculate(BigDecimal $base, BigDecimal $quote, BigDecimal $amount): BigDecimal
    {
        return $base->dividedBy($quote)->multipliedBy($amount);
    }
}
