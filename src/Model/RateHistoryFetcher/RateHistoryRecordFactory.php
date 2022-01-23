<?php

namespace App\Model\RateHistoryFetcher;

interface RateHistoryRecordFactory
{
    public function newRateHistoryRecord(
        string $baseCurrency,
        array $values,
        \DateTimeInterface $at,
        bool $inverse = false
    ): RateHistoryRecord;

}
