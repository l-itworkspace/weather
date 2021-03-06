<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\WeatherRepositoryContract;
use App\ExternalAPI\WeatherAPI\WeatherContext;
use App\Http\Requests\WeatherRequest;
use App\Services\WeatherService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    private WeatherContext $weatherContext;
    private WeatherRepositoryContract $weatherRepository;

    public function __construct(
        WeatherContext $weatherContext,
        WeatherRepositoryContract $weatherRepository
    )
    {
        $this->weatherContext = $weatherContext;
        $this->weatherRepository = $weatherRepository;
    }

    public function getWeather(WeatherRequest $request)
    {
        $temperature = Cache::get($request->latitude . '.' . $request->longitude);

        if (!$temperature) {
            $temperature = (new WeatherService($this->weatherContext))->getTemperature(
                (float) $request->latitude,
                (float) $request->longitude
            );

            $this->weatherRepository->store([...$request->getData(), ...['temperature' => $temperature]]);
            Cache::add($request->latitude . '.' . $request->longitude, $temperature);
        }

        return response()->json($temperature);
    }
}
