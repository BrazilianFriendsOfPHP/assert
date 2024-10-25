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

use InvalidArgumentException;

class Valid
{
    /**
     * @psalm-pure
     *
     * @psalm-assert string $value
     *
     * @param mixed  $value
     */
    public static function string($value): bool
    {
        return \is_string($value);
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert int $value
     *
     * @param mixed  $value
     */
    public static function integer($value): bool
    {
        if (!\is_int($value)) {
            return false;
        }

        return true;
    }

    /**
     * @psalm-pure
     *
     * @psalm-assert numeric $value
     *
     * @param mixed  $value
     */
    public static function integerish($value): bool
    {
        if (!\is_numeric($value) || $value != (int) $value) {
            return false;
        }

        return true;
    }

    /**
     * @psalm-pure
     *
     * @param string $value
     */
    public static function uuid($value): bool
    {
        if (!static::string($value)) {
            return false;
        }

        $value = \str_replace(array('urn:', 'uuid:', '{', '}'), '', $value);

        // The nil UUID is special form of UUID that is specified to have all
        // 128 bits set to zero.
        if ('00000000-0000-0000-0000-000000000000' === $value) {
            return true;
        }

        return \preg_match('/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$/', $value);
    }

    /**
     * @param mixed  $value
     * @param mixed  $expect
     */
    public static function eq($value, $expect): bool
    {
        return $expect == $value;
    }

    public static function and($value, iterable $validators): bool
    {
        foreach ($validators as $validator) {
            if (!$validator($value)) {
                return false;
            }
        }
        return true;
    }

    public static function or($value, iterable $validators): bool
    {
        foreach ($validators as $validator) {
            if ($validator($value)) {
                return true;
            }
        }
        return false;
    }
}