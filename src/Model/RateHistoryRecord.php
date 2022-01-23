<?php

namespace App\Model;

use Brick\Math\BigDecimal;

interface RateHistoryRecord
{
    public function getRate(string $currency): BigDecimal;
}
