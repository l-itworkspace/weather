<?php

declare(strict_types=1);

namespace App\Services;

use App\ExternalAPI\WeatherAPI\OpenWeatherMap;
use App\ExternalAPI\WeatherAPI\WeatherBit;
use App\ExternalAPI\WeatherAPI\WeatherContext;

class WeatherService
{
    private array $weatherAPIs = [
        OpenWeatherMap::class,
        WeatherBit::class
    ];

    private WeatherContext $weatherContext;
    private array $temperatures;

    public function __construct(WeatherContext $weatherContext)
    {
        $this->weatherContext = $weatherContext;
    }

    public function getTemperature(float $latitude, float $longitude): float
    {
        foreach ($this->weatherAPIs as $weatherAPI) {
            $this->weatherContext->setStrategy(new $weatherAPI($latitude, $longitude));
            $this->temperatures[] = $this->weatherContext->getWeatherData();
        }

        return $this->getTemperatureAverage();
    }

    private function getTemperatureAverage(): float
    {
        return round(array_sum($this->temperatures) / count($this->temperatures), 1);
    }
}
