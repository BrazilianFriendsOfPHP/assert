<?php

namespace BRFOP\Assert\Tests\Valid;

trait AssertTestTrait
{
    private function handleAssertTest(bool $mustPass, callable $func): void
    {
        try {
            $func();
            if ($mustPass === false) {
                $this->fail('Must throw exception');
            } else {
                $this->assertTrue(true);
            }
        } catch (\InvalidArgumentException $e) {
            if ($mustPass === true) {
                $this->fail('Must not throw an exception');
            } else {
                $this->assertTrue(true);
            }
        }
    }
}