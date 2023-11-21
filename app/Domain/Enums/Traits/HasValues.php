<?php

namespace App\Domain\Enums\Traits;

trait HasValues
{
    /**
     * @return array<int|string>
     */
    public static function values(): array
    {
        return array_column(self::toArray(), 'value');
    }

    /**
     * @return array<string, mixed>
     */
    public static function toArray(): array
    {
        return (new \ReflectionClass(static::class))->getConstants();
    }

    /**
     * @return array<string, mixed>
     */
    public static function casesKeyIsValue(): array
    {
        return array_combine(self::values(), self::cases());
    }
}
