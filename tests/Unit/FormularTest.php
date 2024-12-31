<?php

namespace Tests\Unit;

use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone1ExemptDto;
use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone2ProgressiveOneDto;
use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone3ProgressiveTwoDto;
use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone4TopRateDto;
use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone5WealthRateDto;
use HankIT\GermanyIncomeTaxCalculator\Exceptions\UnsupportedIncomeException;
use HankIT\GermanyIncomeTaxCalculator\Formular;
use Mockery;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FormularTest extends TestCase
{
    public static function zone_1_data_provider(): array
    {
        return [
            [
                'maxAmount' => 10000,
                'income' => 0,
            ],
            [
                'maxAmount' => 10000,
                'income' => 5000,
            ],
            [
                'maxAmount' => 10000,
                'income' => 10000,
            ],
        ];
    }

    #[Test]
    #[DataProvider('zone_1_data_provider')]
    public function it_calculates_the_tax_for_zone_1(float $maxAmount, float $income)
    {
        $zone1ExemptMock = Mockery::mock(Zone1ExemptDto::class);
        $zone1ExemptMock->shouldReceive('getAmount')->once()->andReturn($maxAmount);

        $zone2ProgressiveOneDtoMock = Mockery::mock(Zone2ProgressiveOneDto::class);
        $zone2ProgressiveOneDtoMock->shouldReceive('getStartAmount')->never();
        $zone2ProgressiveOneDtoMock->shouldReceive('getEndAmount')->never();
        $zone2ProgressiveOneDtoMock->shouldReceive('getMultiplier')->never();

        $zone3ProgressiveTwoDtoMock = Mockery::mock(Zone3ProgressiveTwoDto::class);
        $zone3ProgressiveTwoDtoMock->shouldReceive('getStartAmount')->never();
        $zone3ProgressiveTwoDtoMock->shouldReceive('getEndAmount')->never();
        $zone3ProgressiveTwoDtoMock->shouldReceive('getMultiplier')->never();
        $zone3ProgressiveTwoDtoMock->shouldReceive('getAddition')->never();

        $zone4TopRateDtoMock = Mockery::mock(Zone4TopRateDto::class);
        $zone4TopRateDtoMock->shouldReceive('getStartAmount')->never();
        $zone4TopRateDtoMock->shouldReceive('getEndAmount')->never();
        $zone4TopRateDtoMock->shouldReceive('getSubtraction')->never();

        $zone5WealthRateDtoMock = Mockery::mock(Zone5WealthRateDto::class);
        $zone5WealthRateDtoMock->shouldReceive('getStartAmount')->never();
        $zone5WealthRateDtoMock->shouldReceive('getSubtraction')->never();

        $formular = new Formular(
            $zone1ExemptMock,
            $zone2ProgressiveOneDtoMock,
            $zone3ProgressiveTwoDtoMock,
            $zone4TopRateDtoMock,
            $zone5WealthRateDtoMock,
        );

        $this->assertEquals(0, $formular->calculate($income));
    }

    public static function zone_2_data_provider(): array
    {
        return [
            [
                'exemptAmount' => 500,
                'startAmount' => 501,
                'endAmount' => 1000,
                'multiplier' => 1.5,

                'income' => 501,
                'taxAmount' => 0.14,
            ],
            [
                'exemptAmount' => 500,
                'startAmount' => 501,
                'endAmount' => 1000,
                'multiplier' => 1.5,

                'income' => 750,
                'taxAmount' => 35,
            ],
            [
                'exemptAmount' => 500,
                'startAmount' => 501,
                'endAmount' => 1000,
                'multiplier' => 1.5,

                'income' => 1000,
                'taxAmount' => 70,
            ],
        ];
    }

    #[Test]
    #[DataProvider('zone_2_data_provider')]
    public function it_calculates_the_tax_for_zone_2(float $exemptAmount, float $startAmount, float $endAmount, float $multiplier, float $income, float $taxAmount)
    {
        $zone1ExemptMock = Mockery::mock(Zone1ExemptDto::class);
        $zone1ExemptMock->shouldReceive('getAmount')->twice()->andReturn($exemptAmount);

        $zone2ProgressiveOneDtoMock = Mockery::mock(Zone2ProgressiveOneDto::class);
        $zone2ProgressiveOneDtoMock->shouldReceive('getStartAmount')->once()->andReturn($startAmount);
        $zone2ProgressiveOneDtoMock->shouldReceive('getEndAmount')->once()->andReturn($endAmount);
        $zone2ProgressiveOneDtoMock->shouldReceive('getMultiplier')->once()->andReturn($multiplier);

        $zone3ProgressiveTwoDtoMock = Mockery::mock(Zone3ProgressiveTwoDto::class);
        $zone3ProgressiveTwoDtoMock->shouldReceive('getStartAmount')->never();
        $zone3ProgressiveTwoDtoMock->shouldReceive('getEndAmount')->never();
        $zone3ProgressiveTwoDtoMock->shouldReceive('getMultiplier')->never();
        $zone3ProgressiveTwoDtoMock->shouldReceive('getAddition')->never();

        $zone4TopRateDtoMock = Mockery::mock(Zone4TopRateDto::class);
        $zone4TopRateDtoMock->shouldReceive('getStartAmount')->never();
        $zone4TopRateDtoMock->shouldReceive('getEndAmount')->never();
        $zone4TopRateDtoMock->shouldReceive('getSubtraction')->never();

        $zone5WealthRateDtoMock = Mockery::mock(Zone5WealthRateDto::class);
        $zone5WealthRateDtoMock->shouldReceive('getStartAmount')->never();
        $zone5WealthRateDtoMock->shouldReceive('getSubtraction')->never();

        $formular = new Formular(
            $zone1ExemptMock,
            $zone2ProgressiveOneDtoMock,
            $zone3ProgressiveTwoDtoMock,
            $zone4TopRateDtoMock,
            $zone5WealthRateDtoMock,
        );

        $this->assertEquals(round($taxAmount, 2), round($formular->calculate($income), 2));
    }

    public static function zone_3_data_provider(): array
    {
        return [
            [
                'exemptAmountZone1' => 500,
                'startAmountZone2' => 501,
                'endAmountZone2' => 1000,
                'startAmountZone3' => 1001,
                'endAmountZone3' => 1500,
                'multiplier' => 100,
                'addition' => 500,

                'income' => 1001,
                'taxAmount' => 500.24,
            ],
            [
                'exemptAmountZone1' => 500,
                'startAmountZone2' => 501,
                'endAmountZone2' => 1000,
                'startAmountZone3' => 1001,
                'endAmountZone3' => 1500,
                'multiplier' => 100,
                'addition' => 500,

                'income' => 1250,
                'taxAmount' => 559.99,
            ],
            [
                'exemptAmountZone1' => 500,
                'startAmountZone2' => 501,
                'endAmountZone2' => 1000,
                'startAmountZone3' => 1001,
                'endAmountZone3' => 1500,
                'multiplier' => 100,
                'addition' => 500,

                'income' => 1500,
                'taxAmount' => 620.1,
            ],
        ];
    }

    #[Test]
    #[DataProvider('zone_3_data_provider')]
    public function it_calculates_the_tax_for_zone_3(
        float $exemptAmountZone1,
        float $startAmountZone2,
        float $endAmountZone2,
        float $startAmountZone3,
        float $endAmountZone3,
        float $multiplier,
        float $addition,
        float $income,
        float $taxAmount
    )
    {
        $zone1ExemptMock = Mockery::mock(Zone1ExemptDto::class);
        $zone1ExemptMock->shouldReceive('getAmount')->once()->andReturn($exemptAmountZone1);

        $zone2ProgressiveOneDtoMock = Mockery::mock(Zone2ProgressiveOneDto::class);
        $zone2ProgressiveOneDtoMock->shouldReceive('getStartAmount')->once()->andReturn($startAmountZone2);
        $zone2ProgressiveOneDtoMock->shouldReceive('getEndAmount')->twice()->andReturn($endAmountZone2);
        $zone2ProgressiveOneDtoMock->shouldReceive('getMultiplier')->never();

        $zone3ProgressiveTwoDtoMock = Mockery::mock(Zone3ProgressiveTwoDto::class);
        $zone3ProgressiveTwoDtoMock->shouldReceive('getStartAmount')->once()->andReturn($startAmountZone3);
        $zone3ProgressiveTwoDtoMock->shouldReceive('getEndAmount')->once()->andReturn($endAmountZone3);
        $zone3ProgressiveTwoDtoMock->shouldReceive('getMultiplier')->once()->andReturn($multiplier);
        $zone3ProgressiveTwoDtoMock->shouldReceive('getAddition')->once()->andreturn($addition);

        $zone4TopRateDtoMock = Mockery::mock(Zone4TopRateDto::class);
        $zone4TopRateDtoMock->shouldReceive('getStartAmount')->never();
        $zone4TopRateDtoMock->shouldReceive('getEndAmount')->never();
        $zone4TopRateDtoMock->shouldReceive('getSubtraction')->never();

        $zone5WealthRateDtoMock = Mockery::mock(Zone5WealthRateDto::class);
        $zone5WealthRateDtoMock->shouldReceive('getStartAmount')->never();
        $zone5WealthRateDtoMock->shouldReceive('getSubtraction')->never();

        $formular = new Formular(
            $zone1ExemptMock,
            $zone2ProgressiveOneDtoMock,
            $zone3ProgressiveTwoDtoMock,
            $zone4TopRateDtoMock,
            $zone5WealthRateDtoMock,
        );

        $this->assertEquals(round($taxAmount, 2), round($formular->calculate($income), 2));
    }

    public static function zone_4_data_provider(): array
    {
        return [
            [
                'exemptAmountZone1' => 500,

                'startAmountZone2' => 501,
                'endAmountZone2' => 1000,

                'startAmountZone3' => 1001,
                'endAmountZone3' => 1500,

                'startAmountZone4' => 1501,
                'endAmountZone4' => 5000,

                'subtraction' => 500,

                'income' => 1501,
                'taxAmount' => 130.42,
            ],
            [
                'exemptAmountZone1' => 500,

                'startAmountZone2' => 501,
                'endAmountZone2' => 1000,

                'startAmountZone3' => 1001,
                'endAmountZone3' => 1500,

                'startAmountZone4' => 1501,
                'endAmountZone4' => 5000,

                'subtraction' => 500,

                'income' => 3500,
                'taxAmount' => 970,
            ],
            [
                'exemptAmountZone1' => 500,

                'startAmountZone2' => 501,
                'endAmountZone2' => 1000,

                'startAmountZone3' => 1001,
                'endAmountZone3' => 1500,

                'startAmountZone4' => 1501,
                'endAmountZone4' => 5000,

                'subtraction' => 500,

                'income' => 5000,
                'taxAmount' => 1600,
            ],
        ];
    }

    #[Test]
    #[DataProvider('zone_4_data_provider')]
    public function it_calculates_the_tax_for_zone_4(
        float $exemptAmountZone1,
        float $startAmountZone2,
        float $endAmountZone2,
        float $startAmountZone3,
        float $endAmountZone3,
        float $startAmountZone4,
        float $endAmountZone4,
        float $subtraction,
        float $income,
        float $taxAmount
    )
    {
        $zone1ExemptMock = Mockery::mock(Zone1ExemptDto::class);
        $zone1ExemptMock->shouldReceive('getAmount')->once()->andReturn($exemptAmountZone1);

        $zone2ProgressiveOneDtoMock = Mockery::mock(Zone2ProgressiveOneDto::class);
        $zone2ProgressiveOneDtoMock->shouldReceive('getStartAmount')->once()->andReturn($startAmountZone2);
        $zone2ProgressiveOneDtoMock->shouldReceive('getEndAmount')->once()->andReturn($endAmountZone2);
        $zone2ProgressiveOneDtoMock->shouldReceive('getMultiplier')->never();

        $zone3ProgressiveTwoDtoMock = Mockery::mock(Zone3ProgressiveTwoDto::class);
        $zone3ProgressiveTwoDtoMock->shouldReceive('getStartAmount')->once()->andReturn($startAmountZone3);
        $zone3ProgressiveTwoDtoMock->shouldReceive('getEndAmount')->once()->andReturn($endAmountZone3);
        $zone3ProgressiveTwoDtoMock->shouldReceive('getMultiplier')->never();
        $zone3ProgressiveTwoDtoMock->shouldReceive('getAddition')->never();

        $zone4TopRateDtoMock = Mockery::mock(Zone4TopRateDto::class);
        $zone4TopRateDtoMock->shouldReceive('getStartAmount')->once()->andReturn($startAmountZone4);
        $zone4TopRateDtoMock->shouldReceive('getEndAmount')->once()->andReturn($endAmountZone4);
        $zone4TopRateDtoMock->shouldReceive('getSubtraction')->once()->andReturn($subtraction);

        $zone5WealthRateDtoMock = Mockery::mock(Zone5WealthRateDto::class);
        $zone5WealthRateDtoMock->shouldReceive('getStartAmount')->never();
        $zone5WealthRateDtoMock->shouldReceive('getSubtraction')->never();

        $formular = new Formular(
            $zone1ExemptMock,
            $zone2ProgressiveOneDtoMock,
            $zone3ProgressiveTwoDtoMock,
            $zone4TopRateDtoMock,
            $zone5WealthRateDtoMock,
        );

        $this->assertEquals(round($taxAmount, 2), round($formular->calculate($income), 2));
    }

    public static function zone_5_data_provider(): array
    {
        return [
            [
                'exemptAmountZone1' => 500,

                'startAmountZone2' => 501,
                'endAmountZone2' => 1000,

                'startAmountZone3' => 1001,
                'endAmountZone3' => 1500,

                'startAmountZone4' => 1501,
                'endAmountZone4' => 5000,

                'startAmountZone5' => 5001,

                'subtraction' => 500,

                'income' => 5001,
                'taxAmount' => 1750.45,
            ],
            [
                'exemptAmountZone1' => 500,

                'startAmountZone2' => 501,
                'endAmountZone2' => 1000,

                'startAmountZone3' => 1001,
                'endAmountZone3' => 1500,

                'startAmountZone4' => 1501,
                'endAmountZone4' => 5000,

                'startAmountZone5' => 5001,

                'subtraction' => 500,

                'income' => 10000,
                'taxAmount' => 4000,
            ],
        ];
    }

    #[Test]
    #[DataProvider('zone_5_data_provider')]
    public function it_calculates_the_tax_for_zone_5(
        float $exemptAmountZone1,
        float $startAmountZone2,
        float $endAmountZone2,
        float $startAmountZone3,
        float $endAmountZone3,
        float $startAmountZone4,
        float $endAmountZone4,
        float $startAmountZone5,
        float $subtraction,
        float $income,
        float $taxAmount
    )
    {
        $zone1ExemptMock = Mockery::mock(Zone1ExemptDto::class);
        $zone1ExemptMock->shouldReceive('getAmount')->once()->andReturn($exemptAmountZone1);

        $zone2ProgressiveOneDtoMock = Mockery::mock(Zone2ProgressiveOneDto::class);
        $zone2ProgressiveOneDtoMock->shouldReceive('getStartAmount')->once()->andReturn($startAmountZone2);
        $zone2ProgressiveOneDtoMock->shouldReceive('getEndAmount')->once()->andReturn($endAmountZone2);
        $zone2ProgressiveOneDtoMock->shouldReceive('getMultiplier')->never();

        $zone3ProgressiveTwoDtoMock = Mockery::mock(Zone3ProgressiveTwoDto::class);
        $zone3ProgressiveTwoDtoMock->shouldReceive('getStartAmount')->once()->andReturn($startAmountZone3);
        $zone3ProgressiveTwoDtoMock->shouldReceive('getEndAmount')->once()->andReturn($endAmountZone3);
        $zone3ProgressiveTwoDtoMock->shouldReceive('getMultiplier')->never();
        $zone3ProgressiveTwoDtoMock->shouldReceive('getAddition')->never();

        $zone4TopRateDtoMock = Mockery::mock(Zone4TopRateDto::class);
        $zone4TopRateDtoMock->shouldReceive('getStartAmount')->once()->andReturn($startAmountZone4);
        $zone4TopRateDtoMock->shouldReceive('getEndAmount')->once()->andReturn($endAmountZone4);
        $zone4TopRateDtoMock->shouldReceive('getSubtraction')->never();

        $zone5WealthRateDtoMock = Mockery::mock(Zone5WealthRateDto::class);
        $zone5WealthRateDtoMock->shouldReceive('getStartAmount')->once()->andReturn($startAmountZone5);
        $zone5WealthRateDtoMock->shouldReceive('getSubtraction')->once()->andReturn($subtraction);

        $formular = new Formular(
            $zone1ExemptMock,
            $zone2ProgressiveOneDtoMock,
            $zone3ProgressiveTwoDtoMock,
            $zone4TopRateDtoMock,
            $zone5WealthRateDtoMock,
        );

        $this->assertEquals(round($taxAmount, 2), round($formular->calculate($income), 2));
    }

    #[Test]
    public function it_fails_to_calculate_due_to_unsupported_amount(){
        $zone1ExemptMock = Mockery::mock(Zone1ExemptDto::class);
        $zone1ExemptMock->shouldReceive('getAmount')->once()->andReturn(10);

        $zone2ProgressiveOneDtoMock = Mockery::mock(Zone2ProgressiveOneDto::class);
        $zone2ProgressiveOneDtoMock->shouldReceive('getStartAmount')->once()->andReturn(11);
        $zone2ProgressiveOneDtoMock->shouldReceive('getEndAmount')->once()->andReturn(15);
        $zone2ProgressiveOneDtoMock->shouldReceive('getMultiplier')->never();

        $zone3ProgressiveTwoDtoMock = Mockery::mock(Zone3ProgressiveTwoDto::class);
        $zone3ProgressiveTwoDtoMock->shouldReceive('getStartAmount')->once()->andReturn(16);
        $zone3ProgressiveTwoDtoMock->shouldReceive('getEndAmount')->once()->andReturn(20);
        $zone3ProgressiveTwoDtoMock->shouldReceive('getMultiplier')->never();
        $zone3ProgressiveTwoDtoMock->shouldReceive('getAddition')->never();

        $zone4TopRateDtoMock = Mockery::mock(Zone4TopRateDto::class);
        $zone4TopRateDtoMock->shouldReceive('getStartAmount')->once()->andReturn(21);
        $zone4TopRateDtoMock->shouldReceive('getEndAmount')->once()->andReturn(25);
        $zone4TopRateDtoMock->shouldReceive('getSubtraction')->never();

        $zone5WealthRateDtoMock = Mockery::mock(Zone5WealthRateDto::class);
        $zone5WealthRateDtoMock->shouldReceive('getStartAmount')->once()->andReturn(51);
        $zone5WealthRateDtoMock->shouldReceive('getSubtraction')->never();

        $formular = new Formular(
            $zone1ExemptMock,
            $zone2ProgressiveOneDtoMock,
            $zone3ProgressiveTwoDtoMock,
            $zone4TopRateDtoMock,
            $zone5WealthRateDtoMock,
        );

        $income = 50;

        $this->expectException(UnsupportedIncomeException::class);
        $this->expectExceptionMessage(sprintf('Income %s is not supported by Formular', $income));

        $formular->calculate($income);
    }
}