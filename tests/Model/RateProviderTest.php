<?php

namespace App\Tests\Model;

use App\Model\RateKeeper;
use App\Model\RateKeeperCollection;
use App\Model\RateProvider;
use Brick\Math\BigDecimal;
use PHPUnit\Framework\TestCase;

class RateProviderTest extends TestCase
{
    public function testGet()
    {
        $rateKeeper = $this->createStub(RateKeeper::class);
        $rateKeeper->method('getRate')->willReturn(BigDecimal::one());

        $collection = $this->createMock(RateKeeperCollection::class);
        $collection->expects($this->once())
            ->method('last')
            ->willReturn($rateKeeper);

        $provider = new RateProvider($collection);

        $provider->get('USD', 'RUB');
    }
}
