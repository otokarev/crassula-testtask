<?php

namespace App\Model\RateHistoryFetcher;

interface RateHistoryRecordCollection
{
    public function add(RateHistoryRecord $history);

}
