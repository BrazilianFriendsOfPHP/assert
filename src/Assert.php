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

use DateTime;
use DateTimeImmutable;
use InvalidArgumentException;

class Assert
{
    /**
     * @psalm-pure
     *
     * @psalm-assert string $value
     *
     * @param mixed  $value
     */
    public static function string($value, string $message = ''): void
    {
        if (Valid::string($value)) {
            return;
        }

        static::reportInvalidArgument(\sprintf(
            $message ?: 'Expected a string. Got: %s',
            static::typeToString($value)
        ));
    }

    /**
     * @psalm-pure
     *
     * @param mixed $value
     */
    public static function uuid($value, string $message = ''): void
    {
        if (Valid::uuid($value)) {
            return;
        }

        static::reportInvalidArgument(\sprintf(
            $message ?: 'Value %s is not a valid UUID.',
            static::valueToString($value)
        ));
    }

    /**
     * @param mixed  $value
     * @param mixed  $expect
     *
     * @throws InvalidArgumentException
     */
    public static function eq($value, $expect, string $message = ''): void
    {
        if (Valid::eq($value, $expect)) {
            return;
        }

        static::reportInvalidArgument(\sprintf(
            $message ?: 'Expected a value equal to %2$s. Got: %s',
            static::valueToString($value),
            static::valueToString($expect)
        ));
    }

    public static function and($value, iterable $validators, string $message = ''): void
    {
        if (Valid::and($value, $validators)) {
            return;
        }

        static::reportInvalidArgument(\sprintf(
            $message ?: 'Expected a value to meet all requirements. Got: %s',
            static::valueToString($value)
        ));
    }

    public static function or($value, iterable $validators, string $message = ''): void
    {
        if (Valid::or($value, $validators)) {
            return;
        }

        static::reportInvalidArgument(\sprintf(
            $message ?: 'Expected a value to at least one of the requirements. Got: %s',
            static::valueToString($value)
        ));
    }

    /**
     * @param mixed $value
     */
    protected static function valueToString($value): string
    {
        if (null === $value) {
            return 'null';
        }

        if (true === $value) {
            return 'true';
        }

        if (false === $value) {
            return 'false';
        }

        if (\is_array($value)) {
            return 'array';
        }

        if (\is_object($value)) {
            if (\method_exists($value, '__toString')) {
                return \get_class($value).': '.self::valueToString($value->__toString());
            }

            if ($value instanceof DateTime || $value instanceof DateTimeImmutable) {
                return \get_class($value).': '.self::valueToString($value->format('c'));
            }

            return \get_class($value);
        }

        if (\is_resource($value)) {
            return 'resource';
        }

        if (\is_string($value)) {
            return '"'.$value.'"';
        }

        return (string) $value;
    }

    /**
     * @psalm-pure
     *
     * @param mixed $value
     */
    protected static function typeToString($value): string
    {
        return \is_object($value) ? \get_class($value) : \gettype($value);
    }

    protected static function strlen($value)
    {
        if (!\function_exists('mb_detect_encoding')) {
            return \strlen($value);
        }

        if (false === $encoding = \mb_detect_encoding($value)) {
            return \strlen($value);
        }

        return \mb_strlen($value, $encoding);
    }

    /**
     * @throws InvalidArgumentException
     *
     * @psalm-pure this method is not supposed to perform side-effects
     *
     * @psalm-return never
     */
    protected static function reportInvalidArgument(string $message)
    {
        throw new InvalidArgumentException($message);
    }
}