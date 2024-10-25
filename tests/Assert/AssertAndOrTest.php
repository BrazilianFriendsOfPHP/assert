<?php

namespace BRFOP\Assert\Tests\Assert;

use BRFOP\Assert\Assert;
use BRFOP\Assert\ValidC;
use PHPUnit\Framework\TestCase;

class AssertAndOrTest extends TestCase
{
    use AssertTestTrait;

    /**
     * @dataProvider dataTestOr
     */
    public function testOr($value, bool $mustPass, iterable $validators)
    {
        $this->handleAssertTest($mustPass, static function () use ($value, $validators) {
            Assert::or($value, $validators);
        });
    }

    public static function dataTestOr(): array
    {
        return [
            ['test value', true, [ValidC::integer(), ValidC::eq('test value')]],
            ['wrong value', false, [ValidC::integer(), ValidC::eq('test value')]],
        ];
    }

    /**
     * @dataProvider dataTestAnd
     */
    public function testAnd($value, bool $mustPass, iterable $validators)
    {
        $this->handleAssertTest($mustPass, static function () use ($value, $validators) {
            Assert::and($value, $validators);
        });
    }

    public static function dataTestAnd(): array
    {
        return [
            ['test value', true, [ValidC::string(), ValidC::eq('test value')]],
            ['wrong value', false, [ValidC::string(), ValidC::eq('test value')]],
        ];
    }
}