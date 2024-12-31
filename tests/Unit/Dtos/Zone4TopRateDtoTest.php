<?php

namespace Tests\Unit\Dtos;

use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone4TopRateDto;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class Zone4TopRateDtoTest extends TestCase
{
    #[Test]
    public function it_gets_the_values()
    {
        $dto = new Zone4TopRateDto(
            $startAmount = $this->faker->randomFloat(2, 0, 10000),
            $endAmount = $this->faker->randomFloat(2, 0, 10000),
            $subtraction = $this->faker->randomFloat(2, 0, 10000),
        );

        $this->assertEquals($startAmount, $dto->getStartAmount());
        $this->assertEquals($endAmount, $dto->getEndAmount());
        $this->assertEquals($subtraction, $dto->getSubtraction());
    }
}