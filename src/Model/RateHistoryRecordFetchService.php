<?php

namespace App\Model;

class RateHistoryRecordFetchService
{
    public function __construct(
        private RateHistoryRecordFetcher    $fetcher,
        private RateHistoryRecordCollection $collection
    ) {

    }

    public function fetch()
    {
        $rateHistory = $this->fetcher->fetch();
        $this->collection->add($rateHistory);
    }
}
