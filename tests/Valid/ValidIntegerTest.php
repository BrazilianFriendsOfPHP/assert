<?php

namespace BRFOP\Assert\Tests\Valid;

use BRFOP\Assert\Valid;
use PHPUnit\Framework\TestCase;

class ValidIntegerTest extends TestCase
{
    /**
     * @dataProvider dataTestInteger
     */
    public function testInteger($value, bool $expectedResult)
    {
        $this->assertEquals($expectedResult, Valid::integer($value));
    }

    public static function dataTestInteger(): array
    {
        return [
            [123, true],
            ['123', false],
            [1.0, false],
            [1.3, false],
        ];
    }

    /**
     * @dataProvider dataTestIntegerish
     */
    public function testIntegerish($value, bool $expectedResult)
    {
        $this->assertEquals($expectedResult, Valid::integerish($value));
    }

    public static function dataTestIntegerish(): array
    {
        return [
            [1.0, true],
            [1.23, false],
            [123, true],
            ['123', true],
        ];
    }
}