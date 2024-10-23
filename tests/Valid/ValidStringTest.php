<?php

namespace BRFOP\Assert\Tests;

use BRFOP\Assert\Valid;
use PHPUnit\Framework\TestCase;

class ValidStringTest extends TestCase
{
    /**
     * @dataProvider dataTestString
     */
    public function testString($value, bool $expectedResult)
    {
        $this->assertEquals($expectedResult, Valid::string($value));
    }

    public static function dataTestString(): array
    {
        return [
            ['value', true],
            ['', true],
            [1234, false],
        ];
    }
}