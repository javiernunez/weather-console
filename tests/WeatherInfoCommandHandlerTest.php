<?php
declare(strict_types=1);

namespace tests;

use PHPUnit\Framework\TestCase;
use WeatherApp\WeatherInfoCommandHandler;
use WeatherApp\Exceptions\InvalidLocationException;

final class WeatherInfoCommandHandlerTest extends TestCase
{
    public function validLocations(): array
    {
        return [
            ['Madrid'],
            ['Paris'],
            ['New York'],
        ];
    }

    public function invalidLocations(): array
    {
        return [
            ['123'],
            ['Minsk12']
        ];
    }

    /**
     * @param string $location
     * @dataProvider invalidLocations
     * @throws InvalidLocationException
     */
    public function testExceptionsAreThrownOnInvalidLocation(string $location): void
    {
        $this->expectException(InvalidLocationException::class);

        (new WeatherInfoCommandHandler())(['', $location]);
    }

    public function testExceptionsAreThrownOnEmptyLocation(): void
    {
        $this->expectException(InvalidLocationException::class);

        (new WeatherInfoCommandHandler())([]);
    }
}
