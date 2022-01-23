<?php

namespace App\Factory;

use App\Entity\RateHistoryRecord as RateHistoryRecordEntity;
use App\Model\RateHistoryRecord;
use App\Model\RateHistoryRecordFactory as RateHistoryRecordInterface;

class RateHistoryRecordFactory implements RateHistoryRecordInterface
{

    public function newRateHistoryRecord(
        string $baseCurrency,
        array $values, \DateTimeInterface $at,
        bool $inverse = false
    ): RateHistoryRecord {
        return (new RateHistoryRecordEntity())
            ->setBase($baseCurrency)
            ->setAt($at)
            ->setValues($values)
            ->setInverse($inverse)
        ;
    }
}
