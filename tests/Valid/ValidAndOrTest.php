<?php

namespace BRFOP\Assert\Tests\Valid;

use BRFOP\Assert\Valid;
use BRFOP\Assert\ValidC;
use PHPUnit\Framework\TestCase;

class ValidAndOrTest extends TestCase
{

    /**
     * @dataProvider dataTestOr
     */
    public function testOr($value, bool $expectedResult, iterable $validators)
    {
        $this->assertEquals($expectedResult, Valid::or($value, $validators));
    }

    public static function dataTestOr(): array
    {
        return [
            ['test value', true, [ValidC::integer(), ValidC::eq('test value')]],
            ['wrong value', false, [ValidC::integer(), ValidC::eq('test value')]],
            ['test value', true, [ValidC::eq('wrong value'), ValidC::or([ValidC::integer(), ValidC::eq('test value')])]],
            ['test value', false, [ValidC::eq('wrong value'), ValidC::or([ValidC::integer(), ValidC::eq('another value')])]],
        ];
    }

    /**
     * @dataProvider dataTestAnd
     */
    public function testAnd($value, bool $expectedResult, iterable $validators)
    {
        $this->assertEquals($expectedResult, Valid::and($value, $validators));
    }

    public static function dataTestAnd(): array
    {
        return [
            ['test value', true, [ValidC::string(), ValidC::eq('test value')]],
            ['wrong value', false, [ValidC::string(), ValidC::eq('test value')]],
        ];
    }
}