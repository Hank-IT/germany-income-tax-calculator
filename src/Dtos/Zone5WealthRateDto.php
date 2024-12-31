<?php

namespace HankIT\GermanyIncomeTaxCalculator\Dtos;

/**
 * @internal
 */
class Zone5WealthRateDto
{
    public function __construct(
        protected float $startAmount,
        protected float $subtraction,
    ) {}

    public function getStartAmount(): float
    {
        return $this->startAmount;
    }

    public function getSubtraction(): float
    {
        return $this->subtraction;
    }
}