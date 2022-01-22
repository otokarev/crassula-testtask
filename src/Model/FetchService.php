<?php

namespace App\Model;

class FetchService
{
    public function __construct(
        private RateProviderAdapter $adapter,
        private RateBundleCollection $collection
    ) {

    }

    public function fetch()
    {
        $rateBundle = $this->adapter->fetch();
        $this->collection->add($rateBundle);
    }
}
