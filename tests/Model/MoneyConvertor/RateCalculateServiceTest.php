<?php

namespace App\Tests\Model\MoneyConvertor;

use App\Model\MoneyConvertor\RateKeeper;
use Brick\Math\BigDecimal;
use PHPUnit\Framework\TestCase;

class RateCalculateServiceTest extends TestCase
{
    public function testGetRateForPair()
    {
        $rateKeeper = $this->createMock(RateKeeper::class);
        $rateKeeper->expects($this->any())->method('getRate')
            ->willReturnMap([
                ['USD', BigDecimal::of('70')],
                ['RUB', BigDecimal::of('1')],
            ]);

        $collection = $this->createStub(\App\Model\MoneyConvertor\RateKeeperCollection::class);
        $collection->method('last')->willReturn($rateKeeper);

        $service = new \App\Model\MoneyConvertor\RateCalculateService($collection);

        $this->assertEquals('70', $service->getRateForPair('USD', 'RUB'));
    }
}
