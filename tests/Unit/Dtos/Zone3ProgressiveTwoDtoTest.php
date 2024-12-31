<?php

namespace Tests\Unit\Dtos;

use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone3ProgressiveTwoDto;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class Zone3ProgressiveTwoDtoTest extends TestCase
{
    #[Test]
    public function it_gets_the_values()
    {
        $dto = new Zone3ProgressiveTwoDto(
            $startAmount = $this->faker->randomFloat(2, 0, 10000),
            $endAmount = $this->faker->randomFloat(2, 0, 10000),
            $multiplier = $this->faker->randomFloat(2, 0, 10000),
            $addition = $this->faker->randomFloat(2, 0, 10000),
        );

        $this->assertEquals($startAmount, $dto->getStartAmount());
        $this->assertEquals($endAmount, $dto->getEndAmount());
        $this->assertEquals($multiplier, $dto->getMultiplier());
        $this->assertEquals($addition, $dto->getAddition());
    }
}