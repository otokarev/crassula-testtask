<?php

namespace App\Model\MoneyConvertor;

interface RateKeeperCollection
{
    public function last(): RateKeeper;
}
