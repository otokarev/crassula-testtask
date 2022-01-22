<?php

namespace App\Tests\Model;

use App\Model\CalculatorStrategy;
use App\Model\Rate;
use Brick\Math\BigDecimal;
use Brick\Money\Money;
use PHPUnit\Framework\TestCase;

class CalculatorStrategyTest extends TestCase
{
    public function testCalculate()
    {
        $actual = (new CalculatorStrategy())
            ->calculate(
                new Rate('USD', 'RUB', BigDecimal::of(70)),
                Money::of(10, 'USD')
            );

        $this->assertTrue(Money::of(700, 'RUB')->isEqualTo($actual));
    }
}
