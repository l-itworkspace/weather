<?php

declare(strict_types=1);

namespace App\Contracts;

interface WeatherContract
{
    public function getTemperature(): float;
}
