<?php

namespace HankIT\GermanyIncomeTaxCalculator\Dtos;

/**
 * @internal
 */
class Zone1ExemptDto
{
    public function __construct(protected float $amount) {}

    public function getAmount(): float
    {
        return $this->amount;
    }
}