<?php

declare(strict_types=1);

namespace App\ExternalAPI;

use App\Contracts\LoggableContract;
use App\Traits\LoggerTrait;
use Illuminate\Support\Facades\Http;

abstract class AbstractWeatherAPIRequest implements LoggableContract
{
    use LoggerTrait;

    protected string $url;

    public function makeGetRequest()
    {
        //TODO need to declare return type
        try {
            return (Http::get($this->url));
        } catch (\Exception $e) {
            $this->log($e);
        }

    }

    abstract protected function setUrl( float $latitude, float $longitude): void;
}
