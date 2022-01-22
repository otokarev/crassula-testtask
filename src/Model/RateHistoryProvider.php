<?php

namespace App\Model;

interface RateHistoryProvider
{
    public function fetch(): RateHistory;
}
