<?php

namespace App\Tests\Model;

use App\Entity\RateHistoryRecord;
use App\Model\RateHistoryRecordFetchService;
use App\Model\RateHistoryRecordCollection;
use App\Model\RateHistoryRecordFetcher;
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

        $adapter = $this->createMock(RateHistoryRecordFetcher::class);
        $adapter->expects($this->once())
            ->method('fetch')
            ->willReturn($rateHistory)
        ;

        $convertor = new RateHistoryRecordFetchService($adapter, $collection);

        $convertor->fetch();
    }
}