<?php

namespace App\DesignPattern;

interface WeatherStrategy
{
    public function getTemperature(): int;
}
