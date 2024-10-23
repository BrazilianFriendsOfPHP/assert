<?php

namespace BRFOP\Assert\Tests\Valid;

use BRFOP\Assert\Assert;
use BRFOP\Assert\Valid;
use BRFOP\Assert\ValidCallable;
use PHPUnit\Framework\TestCase;

class AssertAllTest extends TestCase
{
    use AssertTestTrait;

    /**
     * @dataProvider dataTestAll
     */
    public function testAll($value, bool $mustPass, callable ...$validators)
    {
        $this->handleAssertTest($mustPass, fn() => Assert::all($value, ...$validators));
    }

    public static function dataTestAll(): array
    {
        return [
            ['test value', true, ...[Valid::string(...), ValidCallable::eq('test value')]],
            ['wrong value', false, ...[Valid::string(...), ValidCallable::eq('test value')]],
        ];
    }
}