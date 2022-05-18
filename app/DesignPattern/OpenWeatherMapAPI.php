<?php

namespace App\DesignPattern;

class OpenWeatherMapAPI extends AbstractHTTPRequest implements WeatherStrategy
{
    const API_URL = 'https://api.openweathermap.org/data/2.5/';
    private array $location;

    public function __construct(array $location)
    {
        $this->location = $location;
        $this->url = self::API_URL . 'weather?lat=' . $this->location['latitude'] . "&lon=" . $this->location['longitude'] . "&appid=" . env('OPENWEATHERMAP_KEY') . "&units=metric";
    }

    public function getTemperature(): int
    {
        return (int) $this->makeGetRequest()->json()['main']['temp'];
    }
}
