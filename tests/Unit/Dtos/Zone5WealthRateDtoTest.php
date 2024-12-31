<?php

namespace Tests\Unit\Dtos;

use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone5WealthRateDto;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class Zone5WealthRateDtoTest extends TestCase
{
    #[Test]
    public function it_gets_the_values()
    {
        $dto = new Zone5WealthRateDto(
            $startAmount = $this->faker->randomFloat(2, 0, 10000),
            $subtraction = $this->faker->randomFloat(2, 0, 10000),
        );

        $this->assertEquals($startAmount, $dto->getStartAmount());
        $this->assertEquals($subtraction, $dto->getSubtraction());
    }
}