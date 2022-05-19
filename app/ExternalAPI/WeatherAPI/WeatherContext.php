<?php

declare(strict_types=1);

namespace App\ExternalAPI\WeatherAPI;

use App\Contracts\WeatherContract;

class WeatherContext
{
    private WeatherContract $weatherStrategy;

    public function setStrategy(WeatherContract $weatherStrategy)
    {
        $this->weatherStrategy = $weatherStrategy;
    }

    public function getWeatherData(): float
    {
        return $this->weatherStrategy->getTemperature();
    }
}
