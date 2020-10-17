<?php

declare(strict_types=1);

namespace WeatherApp\Services\Weather;

use WeatherApp\Model\Temperature;

abstract class WeatherService
{
    abstract public function getCurrentWeatherText(string $location): string;
    abstract public function getCurrentTemperature(string $location): Temperature;
}
