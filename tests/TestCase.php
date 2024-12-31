<?php

namespace Tests;

use Faker\Factory;
use Faker\Generator;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use MockeryPHPUnitIntegration;

    protected Generator $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
    }
}