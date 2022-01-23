<?php

namespace App\Model;

interface RateHistoryRecordFetcher
{
    public function fetch(): RateHistoryRecord;
}
