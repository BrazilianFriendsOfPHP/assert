<?php

namespace BRFOP\Assert\Tests\Valid;

use BRFOP\Assert\Valid;
use BRFOP\Assert\ValidCallable;
use PHPUnit\Framework\TestCase;

class ValidAllTest extends TestCase
{
    /**
     * @dataProvider dataTestAll
     */
    public function testAll($value, bool $expectedResult, callable ...$validators)
    {
        $this->assertEquals($expectedResult, Valid::all($value, ...$validators));
    }

    public static function dataTestAll(): array
    {
        return [
            ['test value', true, ...[Valid::string(...), ValidCallable::eq('test value')]],
            ['wrong value', false, ...[Valid::string(...), ValidCallable::eq('test value')]],
        ];
    }
}