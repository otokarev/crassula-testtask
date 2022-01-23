<?php

namespace App\Collection;

use App\Entity\RateHistoryRecord;
use App\Model\RateKeeper;
use App\Model\RateKeeperCollection;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineRateKeeperCollection implements RateKeeperCollection
{
    public function __construct(private ManagerRegistry $doctrine) {}

    public function last(): RateKeeper
    {
        return $this->doctrine->getRepository(RateHistoryRecord::class)
            ->findOneBy([], ['at' => 'DESC']);
    }
}
