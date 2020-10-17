<?php

declare(strict_types=1);

namespace WeatherApp\Services;

use WeatherApp\Services\VO\Temperature;

interface WeatherService
{
    public function getCurrentWeatherText(): string;
    public function getCurrentTemperature(): Temperature;
}
