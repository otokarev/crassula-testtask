<?php

namespace App\Model;

use Brick\Math\BigDecimal;

interface RateBundle
{
    public function getRate(string $currency): BigDecimal;
}
