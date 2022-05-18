<?php

namespace App\Http\Controllers;

use App\DesignPattern\GetWeather;
use App\DesignPattern\OpenWeatherMapAPI;
use App\DesignPattern\WeatherBitAPI;
use App\DesignPattern\WeatherContext;
use App\Models\Weather;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use stdClass;

class WeatherController extends Controller
{
    private array $temperatures = [];
//    private WeatherContext $weatherContext;
//    private int $seconds = 3600;
//
//    public function __construct(WeatherContext $weatherContext)
//    {
//        $this->weatherContext = $weatherContext;
//    }

//    /**
//    * @return JsonResponse
//    */
//    public function getWeather(Request $request): JsonResponse
//    {
//        if(Cache::get('weather_id')) {
//            $weather_id = Cache::get('weather_id');
//            $data = Weather::findOrFail($weather_id);
//            $result = $data->temp;
//        } else {
//            Cache::pull('weather_id');
//            $expires_at = Carbon::now()->addHour(1)->format('Y-m-d H:i:s');
//            $data = new stdClass;
//            $data->latitude = $request->latitude;
//            $data->longitude = $request->longitude;
//            $result = $this->getWeather->getResult($data);
//            $temp = Weather::firstOrCreate([
//                'country_id' => $request->country_id,
//                'state_id'   => $request->state_id ?? null,
//                'city_id'    => $request->city_id ?? null,
//                'latitude'   => $request->latitude,
//                'longitude'  => $request->longitude,
//                'temp'       => $result,
//                'expires_at' => $expires_at
//            ]);
//            $temp->save;
//            Cache::add('weather_id', $temp->id, $this->seconds);
//        }
//        return response()->json($result);
//    }

    private function getTemperatureAverage(): int
    {
        return array_sum($this->temperatures) / count($this->temperatures);
    }

    public function getWeather(Request $request): JsonResponse
    {
        $weatherContext = new WeatherContext();
        $weatherContext->setStrategy(new OpenWeatherMapAPI(['latitude' => $request->latitude, 'longitude' => $request->longitude]));
        $this->temperatures[] = $weatherContext->getWeatherData();
        $weatherContext->setStrategy(new WeatherBitAPI(['latitude' => $request->latitude, 'longitude' => $request->longitude]));
        $this->temperatures[] = $weatherContext->getWeatherData();
        return response()->json($this->getTemperatureAverage());
    }
}
