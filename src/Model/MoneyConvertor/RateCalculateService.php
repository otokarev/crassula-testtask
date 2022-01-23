<?php

namespace App\Model\MoneyConvertor;

use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;

class RateCalculateService {
    /**
     * @param RateKeeperCollection $collection
     * @return void
     */
    function __construct(private RateKeeperCollection $collection) {}

    public function getRateForPair($base, $quote): BigDecimal
    {
        $rateKeeper = $this->collection->last();

        return  $rateKeeper->getRate($base)
            ->dividedBy($rateKeeper->getRate($quote), 10, RoundingMode::DOWN);
    }
}
