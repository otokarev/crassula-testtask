<?php

namespace App\Collection;

use App\Entity\RateHistoryRecord;
use App\Model\RateHistory;
use App\Model\RateHistoryCollection;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineRateHistoryCollection implements RateHistoryCollection
{
    public function __construct(private ManagerRegistry $doctrine) {}

    public function last(): RateHistory
    {
        return $this->doctrine->getRepository(RateHistoryRecord::class)
            ->findOneBy([], ['at' => 'DESC']);
    }

    public function add(RateHistory $history): self
    {
        $this->doctrine->getManager()->persist($history);

        return $this;
    }
}
