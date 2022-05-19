<?php

namespace App\Contracts;

interface WeatherRepositoryContract
{
    public function store(array $weatherDetails);
}
