<?php

namespace HankIT\GermanyIncomeTaxCalculator\Dtos;

/**
 * @internal
 */
class Zone3ProgressiveTwoDto
{
    public function __construct(
        protected float $startAmount,
        protected float $endAmount,
        protected float $multiplier,
        protected float $addition,
    ) {}

    public function getStartAmount(): float
    {
        return $this->startAmount;
    }

    public function getEndAmount(): float
    {
        return $this->endAmount;
    }

    public function getMultiplier(): float
    {
        return $this->multiplier;
    }

    public function getAddition(): float
    {
        return $this->addition;
    }
}