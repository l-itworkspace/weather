<?php

declare(strict_types=1);

namespace App\Contracts;

interface LoggableContract
{
    public function log(\Exception $e): void;
}
