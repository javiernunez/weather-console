<?php

namespace WeatherApp\Services\Weather;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use IlluminateAgnostic\Arr\Support\Arr;
use WeatherApp\Controllers\Exceptions\InvalidLocationException;
use WeatherApp\Model\Temperature;

class OpenWeatherMapWeatherService extends WeatherService
{
    protected string $location;
    private Client $client;
    private array $weather;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://api.openweathermap.org/data/2.5/weather',
        ]);
        $this->weather = [];
    }

    /**
     * @return array<array>
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getWeather(string $location): array
    {
        if (empty($this->weather)) {
            try {
                $response = $this->client->request('GET', '', [
                    'query' => [
                        'q' => $location,
                        'appid' => $_ENV['OPEN_WEATHER_API_KEY']
                    ]
                ]);
                $this->weather = json_decode($response->getBody()->getContents(), true);
            } catch(ClientException $e) {
                if(strpos($e->getMessage(), 'Location not found')) {
                    throw InvalidLocationException::notFoundLocation($location);
                } else {
                    throw InvalidLocationException::notValidLocation($location);
                }
            }
        }
        return $this->weather;
    }

    public function getCurrentWeatherText(string $location): string
    {
        $responseData = $this->getWeather($location);
        return Arr::get($responseData, 'weather.0.description');
    }

    public function getCurrentTemperature(string $location): Temperature
    {
        $responseData = $this->getWeather($location);
        return new Temperature(Arr::get($responseData, 'main.temp'), Temperature::KELVIN);
    }
}
