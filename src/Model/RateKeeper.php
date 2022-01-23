<?php

namespace App\Model;

use Brick\Math\BigDecimal;

interface RateKeeper
{
    public function getRate(string $currency): BigDecimal;
}
