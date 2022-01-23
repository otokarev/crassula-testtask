<?php

namespace App\Tests\Model\MoneyConvertor;

use App\Entity\RateHistoryRecord;
use App\Model\RateHistoryFetcher\RateHistoryRecordCollection;
use PHPUnit\Framework\TestCase;

class RateHistoryRecordFetchServiceTest extends TestCase
{
    public function testProcess()
    {
        $rateHistory = new RateHistoryRecord();

        $collection = $this->createMock(RateHistoryRecordCollection::class);
        $collection->expects($this->once())
            ->method('add')
            ->with($this->isInstanceOf(RateHistoryRecord::class))
        ;

        $adapter = $this->createMock(\App\Model\RateHistoryFetcher\RateHistoryRecordFetcher::class);
        $adapter->expects($this->once())
            ->method('fetch')
            ->willReturn($rateHistory)
        ;

        $convertor = new \App\Model\RateHistoryFetcher\RateHistoryRecordFetchService($adapter, $collection);

        $convertor->fetch();
    }
}
