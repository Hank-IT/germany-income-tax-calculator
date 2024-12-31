<?php

namespace HankIT\GermanyIncomeTaxCalculator;

use HankIT\GermanyIncomeTaxCalculator\Exceptions\UnsupportedYearException;

class GermanyIncomeTaxCalculator
{
    public function calculate(int $year, float $income): float
    {
        $years = require __DIR__ . '/YearDataRepository.php';

        if (! isset($years[$year])) {
            throw new UnsupportedYearException($year);
        }

        return (new Formular(...$years[$year]))->calculate($income);
    }
}