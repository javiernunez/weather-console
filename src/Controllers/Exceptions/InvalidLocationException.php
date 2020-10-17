<?php

declare(strict_types=1);

namespace WeatherApp\Controllers\Exceptions;

use Exception;

class InvalidLocationException extends Exception
{
    public const EMPTY_LOCATION = 0;
    public const NOT_VALID_LOCATION = 1;

    public static function emptyLocation(): InvalidLocationException
    {
        return new self('You need to provide a city', self::EMPTY_LOCATION);
    }

    public static function notValidLocation(string $argument): InvalidLocationException
    {
        return new self('Location ' . $argument . ' does not look like a valid location', self::NOT_VALID_LOCATION);
    }

    public static function notFoundLocation(string $argument): InvalidLocationException
    {
        return new self('Location ' . $argument . ' has not been found', self::NOT_VALID_LOCATION);
    }

}
