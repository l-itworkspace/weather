<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LoggerTrait
{
    public function log(\Exception $e): void
    {
        Log::channel('errorException')->info($e);
    }
}
