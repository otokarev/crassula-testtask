<?php

namespace App\Collection;

use App\Model\RateBundle;
use App\Model\RateBundleCollection;
use App\Repository\RatesRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineRateBundleCollection implements RateBundleCollection
{
    public function __construct(private ManagerRegistry $doctrine) {}

    public function last(): RateBundle
    {
        return $this->doctrine->getRepository(RatesRepository::class)
            ->findOneBy([], ['at' => 'DESC']);
    }

    public function add(RateBundle $rateBundle): self
    {
        $this->doctrine->getManager()->persist($rateBundle);

        return $this;
    }
}
