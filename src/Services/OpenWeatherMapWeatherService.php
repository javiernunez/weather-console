<?php

namespace WeatherApp\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use IlluminateAgnostic\Arr\Support\Arr;
use WeatherApp\Services\VO\Temperature;

class OpenWeatherMapWeatherService implements WeatherService
{
    protected string $location;
    private Client $client;
    private array $weather;

    public function __construct(string $location)
    {
        $this->location = $location;
        $this->client = new Client([
            'base_uri' => 'http://api.openweathermap.org/data/2.5/weather',
        ]);
        $this->weather = [];
    }

    /**
     * @return array<array>
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getWeather(): array
    {
        if (empty($this->weather)) {
            $response = $this->client->request('GET', '', [
                'query' => [
                    'q' => $this->location,
                    'appid' => $_ENV['OPEN_WEATHER_API_KEY']
                ]
            ]);
            $this->weather = json_decode($response->getBody()->getContents(), true);
        }
        return $this->weather;
    }

    public function getCurrentWeatherText(): string
    {
        try {
            $responseData = $this->getWeather();
        } catch (GuzzleException $e) {
            print_r("There was a problem with the request");
        }

        return Arr::get($responseData, 'weather.0.description');
    }

    public function getCurrentTemperature(): Temperature
    {
        $responseData = $this->getWeather();
        try {
            $temperature = new Temperature(Arr::get($responseData, 'main.temp'), Temperature::KELVIN);
        } catch (VO\Exceptions\InvalidTemperatureException $e) {
            print_r($e->getMessage());
        }

        return $temperature;
    }
}
