<?php

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

    public static function all($value, callable ...$validator): bool
    {
        foreach ($validator as $func) {
            if (!$func($value)) {
                return false;
            }
        }
        return true;
    }
}