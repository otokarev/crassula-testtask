<?php

namespace App\Tests\Model;

use App\Entity\RateHistoryRecord;
use App\Model\FetchService;
use App\Model\RateHistoryCollection;
use App\Model\RateHistoryProvider;
use PHPUnit\Framework\TestCase;

class FetchServiceTest extends TestCase
{
    public function testProcess()
    {
        $rateHistory = new RateHistoryRecord();

        $collection = $this->createMock(RateHistoryCollection::class);
        $collection->expects($this->once())
            ->method('add')
            ->with($this->isInstanceOf(RateHistoryRecord::class))
        ;

        $adapter = $this->createMock(RateHistoryProvider::class);
        $adapter->expects($this->once())
            ->method('fetch')
            ->willReturn($rateHistory)
        ;

        $convertor = new FetchService($adapter, $collection);

        $convertor->fetch();
    }
}
