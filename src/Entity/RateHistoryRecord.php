<?php

namespace App\Entity;

use App\Model\InvalidRateException;
use App\Model\RateHistoryRecord as RateHistoryRecordInterface;
use App\Model\RateKeeper;
use App\Repository\RateHistoryRecordRepository;
use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RateHistoryRecordRepository::class)]
class RateHistoryRecord implements RateHistoryRecordInterface, RateKeeper
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $at;

    #[ORM\Column(type: 'string', length: 3)]
    private $base;

    #[ORM\Column(type: 'json')]
    private $values = [];

    #[ORM\Column(type: 'boolean')]
    private $inverse = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAt(): ?\DateTimeInterface
    {
        return $this->at;
    }

    public function setAt(\DateTimeInterface $at): self
    {
        $this->at = $at;

        return $this;
    }

    public function getBase(): ?string
    {
        return $this->base;
    }

    public function setBase(string $base): self
    {
        // TODO: add validation
        $this->base = $base;

        return $this;
    }

    public function getValues(): ?array
    {
        return $this->values;
    }

    public function setValues(array $values): self
    {
        // TODO: add validation
        $this->values = $values;

        return $this;
    }

    public function isInverse(): bool
    {
        return $this->inverse;
    }

    public function setInverse(bool $inverse): self
    {
        $this->inverse = $inverse;

        return $this;
    }

    public function getRate(string $currency): BigDecimal
    {
        if(!isset($this->getValues()[$currency])) {
            if ($this->getBase() === $currency) {
                return BigDecimal::one();
            } else {
                throw new InvalidRateException();
            }
        }

        $rate = BigDecimal::of($this->getValues()[$currency]);

        if ($this->isInverse()) {
            $rate = BigDecimal::one()->dividedBy($rate, 100, RoundingMode::DOWN);
        }

        return $rate;
    }
}
