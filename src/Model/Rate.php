<?php

namespace App\Model;

use Brick\Math\BigDecimal;

class Rate
{
    public function __construct(
        private string $baseCurrency,
        private string $quoteCurrency,
        private BigDecimal $value,
    ) {}

    /**
     * @return string
     */
    public function getBaseCurrency(): string
    {
        return $this->baseCurrency;
    }

    /**
     * @return string
     */
    public function getQuoteCurrency(): string
    {
        return $this->quoteCurrency;
    }

    public function getValue(): BigDecimal
    {
        return $this->value;
    }

}
