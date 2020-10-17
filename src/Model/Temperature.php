<?php

declare(strict_types=1);

namespace WeatherApp\Model;

use WeatherApp\Model\Exceptions\InvalidTemperatureException;

class Temperature
{
    public const KELVIN = 'kelvin';
    public const FAHRENHEIT = 'fahrenheit';
    public const CELSIUS = 'celsius';

    private string $unit;
    private float $value;

    public static function units(): array
    {
        return [
            self::KELVIN,
            self::FAHRENHEIT,
            self::CELSIUS
        ];
    }

    public function __construct(float $value, string $unit = self::FAHRENHEIT)
    {
        if (!in_array($unit, self::units(), true)) {
            throw InvalidTemperatureException::notValidTemperatureUnits($unit);
        }

        $this->unit  = $unit;
        $this->value = $value;
    }

    public function getCelsiusValue()
    {
        switch ($this->unit) {
            case self::CELSIUS:     return $this->value;
            case self::KELVIN:      return $this->value - 273.15;
            case self::FAHRENHEIT:  return ($this->value - 32) * 5 / 9;
        }
    }
}
