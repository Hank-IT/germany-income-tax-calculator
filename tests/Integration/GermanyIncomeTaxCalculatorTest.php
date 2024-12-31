<?php

namespace Tests\Integration;

use HankIT\GermanyIncomeTaxCalculator\Exceptions\UnsupportedYearException;
use HankIT\GermanyIncomeTaxCalculator\GermanyIncomeTaxCalculator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GermanyIncomeTaxCalculatorTest extends TestCase
{
    public static function dataProvider()
    {
        return [
            // 2016 Zone 1
            ['year' => 2016, 'income' => 5000, 'expectedTax' => 0],
            // 2016 Zone 2
            ['year' => 2016, 'income' => 12500, 'expectedTax' => 685],
            // 2016 Zone 3
            ['year' => 2016, 'income' => 45000, 'expectedTax' => 10675],
            // 2016 Zone 4
            ['year' => 2016, 'income' => 60000, 'expectedTax' => 16805],
            // 2016 Zone 5
            ['year' => 2016, 'income' => 300000, 'expectedTax' => 118972],


            // 2017 Zone 1
            ['year' => 2017, 'income' => 5000, 'expectedTax' => 0],
            // 2017 Zone 2
            ['year' => 2017, 'income' => 12500, 'expectedTax' => 651],
            // 2017 Zone 3
            ['year' => 2017, 'income' => 45000, 'expectedTax' => 10608],
            // 2017 Zone 4
            ['year' => 2017, 'income' => 60000, 'expectedTax' => 16724],
            // 2017 Zone 5
            ['year' => 2017, 'income' => 300000, 'expectedTax' => 118835],

            // 2018 Zone 1
            ['year' => 2018, 'income' => 5000, 'expectedTax' => 0],
            // 2018 Zone 2
            ['year' => 2018, 'income' => 12500, 'expectedTax' => 612],
            // 2018 Zone 3
            ['year' => 2018, 'income' => 45000, 'expectedTax' => 10496],
            // 2018 Zone 4
            ['year' => 2018, 'income' => 60000, 'expectedTax' => 16578],
            // 2018 Zone 5
            ['year' => 2018, 'income' => 300000, 'expectedTax' => 118562],

            // 2019 Zone 1
            ['year' => 2019, 'income' => 5000, 'expectedTax' => 0],
            // 2019 Zone 2
            ['year' => 2019, 'income' => 12500, 'expectedTax' => 575],
            // 2019 Zone 3
            ['year' => 2019, 'income' => 45000, 'expectedTax' => 10378],
            // 2019 Zone 4
            ['year' => 2019, 'income' => 60000, 'expectedTax' => 16419],
            // 2019 Zone 5
            ['year' => 2019, 'income' => 300000, 'expectedTax' => 118259],

            // 2020 Zone 1
            ['year' => 2020, 'income' => 5000, 'expectedTax' => 0],
            // 2020 Zone 2
            ['year' => 2020, 'income' => 12500, 'expectedTax' => 525],
            // 2020 Zone 3
            ['year' => 2020, 'income' => 45000, 'expectedTax' => 10244],
            // 2020 Zone 4
            ['year' => 2020, 'income' => 60000, 'expectedTax' => 16236],
            // 2020 Zone 5
            ['year' => 2020, 'income' => 300000, 'expectedTax' => 117921],

            // 2021 Zone 1
            ['year' => 2021, 'income' => 5000, 'expectedTax' => 0],
            // 2021 Zone 2
            ['year' => 2021, 'income' => 12500, 'expectedTax' => 461],
            // 2021 Zone 3
            ['year' => 2021, 'income' => 45000, 'expectedTax' => 10111],
            // 2021 Zone 4
            ['year' => 2021, 'income' => 60000, 'expectedTax' => 16063],
            // 2021 Zone 5
            ['year' => 2021, 'income' => 300000, 'expectedTax' => 117625],

            // 2022 Zone 1
            ['year' => 2022, 'income' => 5000, 'expectedTax' => 0],
            // 2022 Zone 2
            ['year' => 2022, 'income' => 12500, 'expectedTax' => 351],
            // 2022 Zone 3
            ['year' => 2022, 'income' => 45000, 'expectedTax' => 9945],
            // 2022 Zone 4
            ['year' => 2022, 'income' => 60000, 'expectedTax' => 15863],
            // 2022 Zone 5
            ['year' => 2022, 'income' => 300000, 'expectedTax' => 117328],

            // 2023 Zone 1
            ['year' => 2023, 'income' => 5000, 'expectedTax' => 0],
            // 2023 Zone 2
            ['year' => 2023, 'income' => 12500, 'expectedTax' => 247],
            // 2023 Zone 3
            ['year' => 2023, 'income' => 45000, 'expectedTax' => 9537],
            // 2023 Zone 4
            ['year' => 2023, 'income' => 65000, 'expectedTax' => 17327],
            // 2023 Zone 5
            ['year' => 2023, 'income' => 300000, 'expectedTax' => 116692],

            // 2024 Zone 1
            ['year' => 2024, 'income' => 5000, 'expectedTax' => 0],
            // 2024 Zone 2
            ['year' => 2024, 'income' => 12500, 'expectedTax' => 105],
            // 2024 Zone 3
            ['year' => 2024, 'income' => 45000, 'expectedTax' => 9121],
            // 2024 Zone 4
            ['year' => 2024, 'income' => 70000, 'expectedTax' => 18763],
            // 2024 Zone 5
            ['year' => 2024, 'income' => 300000, 'expectedTax' => 116028],

            // 2025 Zone 1
            ['year' => 2025, 'income' => 5000, 'expectedTax' => 0],
            // 2025 Zone 2
            ['year' => 2025, 'income' => 12500, 'expectedTax' => 58],
            // 2025 Zone 3
            ['year' => 2025, 'income' => 45000, 'expectedTax' => 8961],
            // 2025 Zone 4
            ['year' => 2025, 'income' => 70000, 'expectedTax' => 18488],
            // 2025 Zone 5
            ['year' => 2025, 'income' => 300000, 'expectedTax' => 115753],
        ];
    }

    #[Test]
    #[DataProvider('dataProvider')]
    public function it_calculates_taxes(int $year, float $income, float $expectedTax)
    {
        $calculator = new GermanyIncomeTaxCalculator;

        $this->assertEquals($expectedTax, (int) $calculator->calculate($year, $income));
    }

    #[Test]
    public function it_fails_to_calculate_taxes_due_to_invalid_year()
    {
        $calculator = new GermanyIncomeTaxCalculator;

        $year = 2015;

        $this->expectException(UnsupportedYearException::class);
        $this->expectExceptionMessage($year);

        $calculator->calculate($year, 10000);
    }
}