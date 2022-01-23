<?php

namespace App\Tests\Model\MoneyConvertor;

use App\Model\MoneyConvertor\ConvertorService;
use App\Model\MoneyConvertor\RateCalculateService;
use App\Model\Rate;
use Brick\Math\BigDecimal;
use Brick\Money\Money;
use PHPUnit\Framework\TestCase;

class ConvertorServiceTest extends TestCase
{
    public function testConvert()
    {
        $rateProvider = $this->createMock(RateCalculateService::class);
        $rateProvider->expects($this->once())
            ->method('getRateForPair')
            ->with('USD', 'RUB')
            ->willReturn(BigDecimal::of('70'))
        ;

        $convertor = new ConvertorService($rateProvider);

        $money = Money::of('2', 'USD');

        $this->assertTrue(
            $convertor->convert($money, 'RUB')->isEqualTo(Money::of('140', 'RUB'))
        );
    }
}
