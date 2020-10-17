<?php

declare(strict_types=1);

namespace tests\Services;

use PHPUnit\Framework\TestCase;
use WeatherApp\Services\OpenWeatherMapWeatherService;
use WeatherApp\Services\VO\Temperature;

final class OpenWeatherAPITest extends TestCase
{

    public function testWeatherInfoIsGatheredFromTheAPI(): void
    {
        $_ENV['OPEN_WEATHER_API_KEY'] = 'c0f764ce5e4c25576b8d6325fc223810';
        $openWeatherAPIService = new OpenWeatherMapWeatherService('Madrid');

        $temperature = $openWeatherAPIService->getCurrentTemperature();

        self::assertEquals(Temperature::KELVIN, $temperature->getUnit());
    }

    public function testNotValidLocation(): void
    {
        $_ENV['OPEN_WEATHER_API_KEY'] = 'c0f764ce5e4c25576b8d6325fc223810';
        $openWeatherAPIService = new OpenWeatherMapWeatherService('PPGPDPDSGPSDFPDSFPDSPFSDPFP');

        $temperature = $openWeatherAPIService->getCurrentTemperature();

        self::assertEquals(Temperature::KELVIN, $temperature->getUnit());
    }

}
