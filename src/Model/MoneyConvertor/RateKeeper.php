<?php

namespace App\Model\MoneyConvertor;

use Brick\Math\BigDecimal;

interface RateKeeper
{
    public function getRate(string $currency): BigDecimal;
}
