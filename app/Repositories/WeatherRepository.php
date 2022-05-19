<?php

namespace App\Repositories;

use App\Contracts\WeatherRepositoryContract;
use App\Models\Weather;

class WeatherRepository implements WeatherRepositoryContract
{
    protected $model;


    public function __construct(Weather $wather)
    {
        $this->model = $wather;
    }


    public function store(array $weatherDetails)
    {
        return $this->model->create($weatherDetails);
    }
}
