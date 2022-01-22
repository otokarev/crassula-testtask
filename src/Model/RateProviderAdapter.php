<?php

namespace App\Model;

interface RateProviderAdapter
{
    public function fetch(): RateBundle;
}
