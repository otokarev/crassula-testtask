<?php

namespace App\Model;

class RateHistoryRecordFetchService
{
    public function __construct(
        private RateHistoryProvider $provider,
        private RateHistoryRecordCollection $collection
    ) {

    }

    public function fetch()
    {
        $rateHistory = $this->provider->fetch();
        $this->collection->add($rateHistory);
    }
}
