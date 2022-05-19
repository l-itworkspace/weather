<?php

declare(strict_types=1);

namespace App\ExternalAPI\WeatherAPI;

use App\Contracts\WeatherContract;
use App\ExternalAPI\AbstractWeatherAPIRequest;

class OpenWeatherMap extends AbstractWeatherAPIRequest implements WeatherContract
{
    const API_URL = 'https://api.openweathermap.org/data/2.5/';

    public function __construct(float $latitude, float $longitude)
    {
        $this->setUrl($longitude, $latitude);
    }

    public function getTemperature(): float
    {
        return (float) $this->makeGetRequest()->json()['main']['temp'];
    }

    protected function setUrl(float $latitude, float $longitude): void
    {
        $this->url = self::API_URL . 'weather?lat=' . $latitude . "&lon=" . $longitude . "&appid=" . env('OPENWEATHERMAP_KEY') . "&units=metric";
    }

}
