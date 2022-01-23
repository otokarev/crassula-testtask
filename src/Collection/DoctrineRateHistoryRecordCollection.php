<?php

namespace App\Collection;

use App\Model\RateHistoryFetcher\RateHistoryRecord;
use App\Model\RateHistoryFetcher\RateHistoryRecordCollection;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineRateHistoryRecordCollection implements RateHistoryRecordCollection
{
    public function __construct(private ManagerRegistry $doctrine) {}

    public function add(RateHistoryRecord $history): self
    {
        $this->doctrine->getManager()->persist($history);

        return $this;
    }
}
