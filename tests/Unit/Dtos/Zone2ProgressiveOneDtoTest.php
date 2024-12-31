<?php

namespace Tests\Unit\Dtos;

use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone2ProgressiveOneDto;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class Zone2ProgressiveOneDtoTest extends TestCase
{
    #[Test]
    public function it_gets_the_values()
    {
        $dto = new Zone2ProgressiveOneDto(
            $startAmount = $this->faker->randomFloat(2, 0, 10000),
            $endAmount = $this->faker->randomFloat(2, 0, 10000),
            $multiplier = $this->faker->randomFloat(2, 0, 10000),
        );

        $this->assertEquals($startAmount, $dto->getStartAmount());
        $this->assertEquals($endAmount, $dto->getEndAmount());
        $this->assertEquals($multiplier, $dto->getMultiplier());
    }
}