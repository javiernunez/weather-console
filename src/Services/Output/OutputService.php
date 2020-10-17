<?php

declare(strict_types=1);

namespace WeatherApp\Services\Output;


use WeatherApp\Model\Temperature;

abstract class OutputService
{
    abstract public function printTemperature(Temperature $temperature, string $weather, string $location): void;
    abstract public function printError(string $errorMessage): void;
}
