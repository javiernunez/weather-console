<?php

declare(strict_types=1);

namespace  Tests\Services;

use PHPUnit\Framework\TestCase;
use WeatherApp\Controllers\Exceptions\InvalidLocationException;
use WeatherApp\Model\Temperature;
use WeatherApp\Services\Weather\OpenWeatherMapWeatherService;

final class OpenWeatherAPITest extends TestCase
{

    public function testWeatherInfoIsGatheredFromTheAPI(): void
    {
        $temperature = (new OpenWeatherMapWeatherService())->getCurrentTemperature('Madrid');

        self::assertInstanceOf(Temperature::class, $temperature);
    }

    public function testNotValidLocation(): void
    {
        $this->expectException(InvalidLocationException::class);

        $temperature = (new OpenWeatherMapWeatherService())->getCurrentTemperature('NON EXISTENT LOCATION');

        self::assertEquals(Temperature::KELVIN, $temperature->getUnit());
    }

    public function setUp()
    {
        $_ENV['OPEN_WEATHER_API_KEY'] = 'c0f764ce5e4c25576b8d6325fc223810';
    }

}
