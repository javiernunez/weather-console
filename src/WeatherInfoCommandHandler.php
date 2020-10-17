<?php

declare(strict_types=1);

namespace WeatherApp;

use WeatherApp\Exceptions\InvalidLocationException;
use WeatherApp\Services\OpenWeatherMapWeatherService;

class WeatherInfoCommandHandler
{

    /**
     * @param array<mixed> $argv
     * @throws InvalidLocationException
     */
    public function __invoke(array $argv): void
    {
        $location = $argv[1];

        if(!$location) {
            throw InvalidLocationException::emptyLocation();
        }

        if(!$this->isAValidLocationName($location)) {
            throw InvalidLocationException::notValidLocation($location);
        }

        $weatherService = new OpenWeatherMapWeatherService($location);
        $weatherText = $weatherService->getCurrentWeatherText();
        $weatherTemperature = $weatherService->getCurrentTemperature();

        print_r("Weather for $location is $weatherText" . "\n");
        print_r("Temperature in $location is " . $weatherTemperature->getCelsiusValue());
    }

    /**
     * @param $locationName
     * @return bool
     */
    private function isAValidLocationName(string $locationName): bool
    {
        return (bool)preg_match('/^[\p{L} ]+$/u', $locationName);
    }

}
