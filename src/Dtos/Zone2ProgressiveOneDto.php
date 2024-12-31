<?php

namespace HankIT\GermanyIncomeTaxCalculator\Dtos;

/**
 * @internal
 */
class Zone2ProgressiveOneDto
{
    public function __construct(
        protected float $startAmount,
        protected float $endAmount,
        protected float $multiplier,
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
}