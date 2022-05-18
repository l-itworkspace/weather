<?php

namespace App\DesignPattern;

class WeatherBitAPI  extends AbstractHTTPRequest implements WeatherStrategy
{
    const API_URL = 'https://api.weatherbit.io/v2.0/';
    private array $location;

    public function __construct(array $location)
    {
        $this->location = $location;
        $this->url = self::API_URL . 'current?lat=' . $this->location['latitude']."&lon=" . $this->location['longitude']."&key=".env('WEATHERBIT_KEY')."&include=minutely";
    }

    public function getTemperature(): int
    {
        return (int) $this->makeGetRequest()->json()['data'][0]['temp'];
    }
}
