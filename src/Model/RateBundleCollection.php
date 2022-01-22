<?php

namespace App\Model;

interface RateBundleCollection
{
    public function last(): RateBundle;

    public function add(RateBundle $rateBundle);

}
