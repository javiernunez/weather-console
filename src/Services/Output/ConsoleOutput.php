<?php

declare(strict_types=1);

namespace WeatherApp\Services\Output;

use WeatherApp\Model\Temperature;

class ConsoleOutput extends OutputService
{

    public function printTemperature(Temperature $temperature, string $weather, string $location): void
    {
        print(sprintf("\n\e[1mWEATHER INFO ABOUT \e[34;1m%s\e[0m \n\n", $location));
        print(sprintf("Temperature is \e[32;1m %d ºC\e[0m \n", $temperature->getCelsiusValue()));
        print(sprintf("Weather is \e[32m %s\n", $weather));
    }

    public function printError(string $errorMessage): void
    {
        print "\e[31;1mERROR\e[0m getting the weather: \n";
        print "\e[31m$errorMessage \n";
    }
}
