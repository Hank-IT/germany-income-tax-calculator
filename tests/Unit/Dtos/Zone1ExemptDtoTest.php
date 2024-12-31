<?php

namespace Tests\Unit\Dtos;

use HankIT\GermanyIncomeTaxCalculator\Dtos\Zone1ExemptDto;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class Zone1ExemptDtoTest extends TestCase
{
    #[Test]
    public function it_gets_the_amount()
    {
        $dto = new Zone1ExemptDto($amount = $this->faker->randomFloat(2, 0, 10000));

        $this->assertEquals($amount, $dto->getAmount());
    }
}