<?php

namespace App\Model;

use Brick\Math\BigDecimal;

interface RateHistory
{
    public function getRate(string $currency): BigDecimal;
}
