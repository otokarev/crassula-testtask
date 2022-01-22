<?php

namespace App\Model;

interface RateHistoryCollection
{
    public function last(): RateHistory;

    public function add(RateHistory $history);

}
