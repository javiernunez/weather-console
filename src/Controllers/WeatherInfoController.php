<?php
declare(strict_types=1);

namespace WeatherApp\Controllers;

use WeatherApp\Controllers\Exceptions\InvalidLocationException;
use WeatherApp\Services\Output\OutputService;
use WeatherApp\Services\Weather\WeatherService;

class WeatherInfoController
{
    private WeatherService $weatherService;
    private OutputService $output;

    public function __construct(WeatherService $weatherService, OutputService $output)
    {
        $this->weatherService = $weatherService;
        $this->output = $output;
    }

    /**
     * @param string $location
     * @throws InvalidLocationException
     */
    public function printWeather(string $location): void
    {

        if(!$this->isAValidLocationName($location)) {
            throw InvalidLocationException::notValidLocation($location);
        }

        try {
            $weatherText = $this->weatherService->getCurrentWeatherText($location);
            $weatherTemperature = $this->weatherService->getCurrentTemperature($location);

            $this->output->printTemperature($weatherTemperature, $weatherText, $location);

        } catch (InvalidLocationException $e) {
            $this->output->printError($e->getMessage());
        }

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
