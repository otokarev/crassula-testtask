<?php

namespace App\Model\RateHistoryFetcher;

interface RateHistoryRecordFetcher
{
    public function fetch(): RateHistoryRecord;
}
