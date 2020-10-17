<?php
declare(strict_types=1);

namespace  Tests\Controllers;

use PHPUnit\Framework\TestCase;
use WeatherApp\Controllers\Exceptions\InvalidLocationException;
use WeatherApp\Controllers\WeatherInfoController;
use WeatherApp\Services\Output\ConsoleOutput;
use WeatherApp\Services\Weather\OpenWeatherMapWeatherService;

final class WeatherInfoControllerTest extends TestCase
{
    /**
     * @return array<array>
     */
    public function validLocations(): array
    {
        return [
            ['Madrid'],
            ['Paris'],
            ['New York'],
        ];
    }

    /**
     * @return array<array>
     */
    public function invalidLocations(): array
    {
        return [
            ['123'],
            ['Minsk12']
        ];
    }

    /**
     * @dataProvider invalidLocations
     */
    public function testExceptionsAreThrownOnInvalidLocation(string $location): void
    {
        $this->expectException(InvalidLocationException::class);

        $weatherService = new OpenWeatherMapWeatherService();
        $outputService = new ConsoleOutput();
        (new WeatherInfoController($weatherService, $outputService))->printWeather($location);
    }

    public function testExceptionsAreThrownOnEmptyLocation(): void
    {
        $this->expectException(InvalidLocationException::class);

        $weatherService = new OpenWeatherMapWeatherService();
        $outputService = new ConsoleOutput();
        (new WeatherInfoController($weatherService, $outputService))->printWeather('');
    }

}
