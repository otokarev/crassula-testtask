<?php

namespace App\Tests\Model;

use App\Model\CalculatorStrategy;
use App\Model\ConvertorService;
use App\Model\Rate;
use App\Model\RateProvider;
use Brick\Money\Money;
use PHPUnit\Framework\TestCase;

class ConvertorServiceTest extends TestCase
{
    public function testConvert()
    {
        $rateProvider = $this->createMock(RateProvider::class);
        $rateProvider->expects($this->once())
            ->method('get')
            ->with($this->equalTo('USD'), $this->equalTo('RUB'))
            ->willReturn($this->createStub(Rate::class))
        ;

        $strategy = $this->createMock(CalculatorStrategy::class);
        $strategy->expects($this->once())
            ->method('calculate')
            ->with(
                $this->isInstanceOf(Rate::class),
                $this->isInstanceOf(Money::class),
            )
            ->willReturn(Money::of(140, 'RUB'))
        ;

        $convertor = new ConvertorService($rateProvider, $strategy);

        $money = Money::of('2', 'USD');

        $convertor->convert($money, 'RUB');
    }
}
