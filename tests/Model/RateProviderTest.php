<?php

namespace App\Tests\Model;

use App\Model\RateHistory;
use App\Model\RateHistoryCollection;
use App\Model\RateProvider;
use Brick\Math\BigDecimal;
use PHPUnit\Framework\TestCase;

class RateProviderTest extends TestCase
{
    public function testGet()
    {
        $rateHistory = $this->createStub(RateHistory::class);
        $rateHistory->method('getRate')->willReturn(BigDecimal::one());

        $collection = $this->createMock(RateHistoryCollection::class);
        $collection->expects($this->once())
            ->method('last')
            ->willReturn($rateHistory);

        $provider = new RateProvider($collection);

        $provider->get('USD', 'RUB');
    }
}
