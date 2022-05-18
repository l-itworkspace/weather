<?php

namespace App\DesignPattern;

use Illuminate\Support\Facades\Http;
use App\DesignPattern\Traits\LoggerTrait;

abstract class AbstractHTTPRequest
{
    use LoggerTrait;

    protected string $url;

    public function makeGetRequest()
    {
        try {
            return Http::get($this->url);
        } catch (\Exception $e) {
            $this->log($e);
        }
    }
}
