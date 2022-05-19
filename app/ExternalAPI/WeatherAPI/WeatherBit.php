<?php

declare(strict_types=1);

namespace App\ExternalAPI\WeatherAPI;

use App\Contracts\WeatherContract;
use App\ExternalAPI\AbstractWeatherAPIRequest;

class WeatherBit extends AbstractWeatherAPIRequest implements WeatherContract
{
    const API_URL = 'https://api.weatherbit.io/v2.0/';

    public function __construct(float $latitude, float $longitude)
    {
        $this->setUrl($longitude, $latitude);
    }

    public function getTemperature(): float
    {
        return (int) $this->makeGetRequest()->json()['data'][0]['temp'];
    }

    protected function setUrl(float $latitude, float $longitude): void
    {
        $this->url = self::API_URL . 'current?lat=' . $latitude . "&lon=" . $longitude . "&key=" . env('WEATHERBIT_KEY') . "&include=minutely";
    }
}
