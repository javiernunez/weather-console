<?php

declare(strict_types=1);

namespace Tests\Model;

use PHPUnit\Framework\TestCase;
use WeatherApp\Model\Temperature;
use WeatherApp\Model\Exceptions\InvalidTemperatureException;

final class TemperatureTest  extends TestCase
{
    /**
     * @return array<array>
     */
    public function validTemperatureUnits(): array
    {
        return [
            [Temperature::CELSIUS],
            [Temperature::KELVIN],
            [Temperature::FAHRENHEIT],
        ];
    }

    /**
     * @return array<array>
     */
    public function invalidTemperatureUnits(): array
    {
        return [
            ['Faerneit'],
            ['º']
        ];
    }

    /**
     * @dataProvider invalidTemperatureUnits
     */
    public function testExceptionsAreThrownOnInvalidTemperatureUnit(string $temperatureUnit): void
    {
        $this->expectException(InvalidTemperatureException::class);

        new Temperature(12.5, $temperatureUnit);
    }
}
