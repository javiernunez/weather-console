<?php

declare(strict_types=1);

namespace WeatherApp\Services\VO;

use WeatherApp\Services\VO\Exceptions\InvalidTemperatureException;

class Temperature
{
    const KELVIN = 'kelvin';
    const FAHRENHEIT = 'fahrenheit';
    const CELSIUS = 'celsius';

    private $unit;
    private $value;

    public static function units(): array
    {
        return [
            self::KELVIN,
            self::FAHRENHEIT,
            self::CELSIUS
        ];
    }

    public function __construct($value, string $unit = self::FAHRENHEIT)
    {
        if (!in_array($unit, self::units(), true)) {
            throw InvalidTemperatureException::notValidTemperatureUnits($unit);
        }

        if (!is_numeric($value)) {
            throw InvalidTemperatureException::notValidValue($value);
        }

        $this->unit  = $unit;
        $this->value = (float)$value;
    }

    public function getUnit()
    {
        return $this->unit;
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
