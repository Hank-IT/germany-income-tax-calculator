<?php

namespace HankIT\GermanyIncomeTaxCalculator;

use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone1ExemptDto;
use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone2ProgressiveOneDto;
use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone3ProgressiveTwoDto;
use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone4TopRateDto;
use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone5WealthRateDto;
use HankIT\GermanyIncomeTaxCalculator\Exceptions\UnsupportedIncomeException;

/**
 * @internal
 */
class Formular
{
    public function __construct(
        protected Zone1ExemptDto         $zone1ExemptDto,
        protected Zone2ProgressiveOneDto $zone2ProgressiveOneDto,
        protected Zone3ProgressiveTwoDto $zone3ProgressiveTwoDto,
        protected Zone4TopRateDto        $zone4TopRateDto,
        protected Zone5WealthRateDto     $zone5WealthRateDto,
    ) {}

    public function calculate(float $income): float
    {
        if ($this->inZone($income, 0, $this->zone1ExemptDto->getAmount())) {
            return 0;
        }

        if ($this->inZone($income, $this->zone2ProgressiveOneDto->getStartAmount(), $this->zone2ProgressiveOneDto->getEndAmount())) {
            $y = ($income - $this->zone1ExemptDto->getAmount()) / 10000;

            return ($this->zone2ProgressiveOneDto->getMultiplier() * $y + 1400) * $y;
        }

        if ($this->inZone($income, $this->zone3ProgressiveTwoDto->getStartAmount(), $this->zone3ProgressiveTwoDto->getEndAmount())) {
            $z = ($income - $this->zone2ProgressiveOneDto->getEndAmount()) / 10000;

            return ($this->zone3ProgressiveTwoDto->getMultiplier() * $z + 2397) * $z + $this->zone3ProgressiveTwoDto->getAddition();
        }

        if ($this->inZone($income, $this->zone4TopRateDto->getStartAmount(), $this->zone4TopRateDto->getEndAmount())) {
            return 0.42 * $income - $this->zone4TopRateDto->getSubtraction();
        }

        if ($this->inZone($income, $this->zone5WealthRateDto->getStartAmount(), null)) {
            return 0.45 * $income - $this->zone5WealthRateDto->getSubtraction();
        }

        throw new UnsupportedIncomeException(sprintf('Income %s is not supported by Formular', $income));
    }

    protected function inZone(float $income, float $start, ?float $end): bool
    {
        if (is_null($end)) {
            return $start <= $income;
        }

        return $start <= $income && $income <= $end;
    }
}