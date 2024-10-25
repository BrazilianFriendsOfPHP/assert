<?php

namespace BRFOP\Assert\Tests\Valid;

use BRFOP\Assert\Valid;
use PHPUnit\Framework\TestCase;

class ValidUuidTest extends TestCase
{
    /**
     * @dataProvider dataTest
     */
    public function testUuid($value, bool $expectedResult)
    {
        $this->assertEquals($expectedResult, Valid::uuid($value));
    }

    public static function dataTest(): array
    {
        return [
            ['00000000-0000-0000-0000-000000000000', true],
            ['urn:ff6f8cb0-c57d-21e1-9b21-0800200c9a66', true],
            ['uuid:{ff6f8cb0-c57d-21e1-9b21-0800200c9a66}', true],
            ['ff6f8cb0-c57d-21e1-9b21-0800200c9a66', true],
            ['ff6f8cb0-c57d-11e1-9b21-0800200c9a66', true],
            ['ff6f8cb0-c57d-31e1-9b21-0800200c9a66', true],
            ['ff6f8cb0-c57d-41e1-9b21-0800200c9a66', true],
            ['ff6f8cb0-c57d-51e1-9b21-0800200c9a66', true],
            ['FF6F8CB0-C57D-11E1-9B21-0800200C9A66', true],
            ['zf6f8cb0-c57d-11e1-9b21-0800200c9a66', false],
            ['af6f8cb0c57d11e19b210800200c9a66', false],
            ['ff6f8cb0-c57da-51e1-9b21-0800200c9a66', false],
            ['af6f8cb-c57d-11e1-9b21-0800200c9a66', false],
            ['3f6f8cb0-c57d-11e1-9b21-0800200c9a6', false],
        ];
    }
}