<?php

namespace App\Entity;

use App\Repository\RatesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RatesRepository::class)]
class Rates
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
        $this->base = $base;

        return $this;
    }

    public function getValues(): ?array
    {
        return $this->values;
    }

    public function setValues(array $values): self
    {
        $this->values = $values;

        return $this;
    }
}
