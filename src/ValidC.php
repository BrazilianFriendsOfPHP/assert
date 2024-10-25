<?php

/*
 * This file is part of the brfop/assert package.
 *
 * (c) Paulo Ribeiro <ribeiro.paulor@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BRFOP\Assert;

class ValidC
{
    public static function string(): callable
    {
        return function ($value) {
            return Valid::string($value);
        };
    }

    public static function integer(): callable
    {
        return function ($value) {
            return Valid::integer($value);
        };
    }

    public static function integerish(): callable
    {
        return function ($value) {
            return Valid::integerish($value);
        };
    }

    public static function eq($expected): callable
    {
        return function ($value) use ($expected) {
            return Valid::eq($value, $expected);
        };
    }

    public static function or(iterable $validators): callable
    {
        return function ($value) use ($validators) {
            return Valid::or($value, $validators);
        };
    }

    public static function and(iterable $validators): callable
    {
        return function ($value) use ($validators) {
            return Valid::and($value, $validators);
        };
    }
}