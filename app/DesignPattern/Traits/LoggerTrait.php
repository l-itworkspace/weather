<?php

namespace App\DesignPattern\Traits;

use Illuminate\Support\Facades\Log;

trait LoggerTrait
{
    public function log($e)
    {
        Log::channel('errorException')->info($e);
    }
}
