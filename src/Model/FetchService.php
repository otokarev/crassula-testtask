<?php

namespace App\Model;

class FetchService
{
    public function __construct(
        private RateHistoryProvider   $provider,
        private RateHistoryCollection $collection
    ) {

    }

    public function fetch()
    {
        $rateHistory = $this->provider->fetch();
        $this->collection->add($rateHistory);
    }
}
