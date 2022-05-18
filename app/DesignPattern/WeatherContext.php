<?php

namespace App\DesignPattern;

class WeatherContext
{
    private WeatherStrategy $weatherStrategy;

    public function setStrategy(WeatherStrategy $weatherStrategy)
    {
        $this->weatherStrategy = $weatherStrategy;
    }

    public function getWeatherData(): int
    {
        return $this->weatherStrategy->getTemperature();
    }
}
