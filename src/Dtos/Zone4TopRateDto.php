<?php

namespace HankIT\GermanyIncomeTaxCalculator\Dtos;

/**
 * @internal
 */
class Zone4TopRateDto
{
    public function __construct(
        protected float $startAmount,
        protected float $endAmount,
        protected float $subtraction,
    ) {}

    public function getStartAmount(): float
    {
        return $this->startAmount;
    }

    public function getEndAmount(): float
    {
        return $this->endAmount;
    }

    public function getSubtraction(): float
    {
        return $this->subtraction;
    }
}