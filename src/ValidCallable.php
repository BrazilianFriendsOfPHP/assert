<?php

namespace BRFOP\Assert;

class ValidCallable
{
    public static function eq($expected): callable {
        return function ($value) use ($expected) {
            return Valid::eq($value, $expected);
        };
    }
}