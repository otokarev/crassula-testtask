<?php

namespace App\Model;

interface RateHistoryRecordFactory
{
    public function newRateHistoryRecord(
        string $baseCurrency,
        array $values,
        \DateTimeInterface $at,
        bool $inverse = false
    ): RateHistoryRecord;

}
