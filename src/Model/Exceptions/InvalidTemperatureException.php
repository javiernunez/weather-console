<?php

declare(strict_types=1);

namespace WeatherApp\Model\Exceptions;

use Exception;

class InvalidTemperatureException extends Exception
{
    public const NOT_VALID_TEMPERATURE_UNITS = 0;
    public const NOT_VALID_VALUE = 1;

    public static function notValidTemperatureUnits(string $unit): InvalidTemperatureException
    {
        return new self('Unit ' . $unit . ' is not a valid unit', self::NOT_VALID_TEMPERATURE_UNITS);
    }

    public static function notValidValue(int $value): InvalidTemperatureException
    {
        return new self('Temperature ' . $value . ' not valid', self::NOT_VALID_VALUE);
    }

}
