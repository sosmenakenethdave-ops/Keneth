<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
    {
        $city = $request->query('city', config('services.openweather.default_city'));
        $apiKey = config('services.openweather.key');

        if (!$apiKey) {
            return response()->json(['error' => 'Walang API Key na naka-set.'], 500);
        }

        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric'
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Hindi mahanap ang lugar.'], 404);
    }

    // Bagong Endpoint para sa Live Autocomplete Search ng mga Lugar
    public function searchLocations(Request $request)
    {
        $query = $request->query('q');
        $apiKey = config('services.openweather.key');

        if (!$apiKey) {
            return response()->json(['error' => 'Walang API Key na naka-set.'], 500);
        }

        if (!$query || strlen(trim($query)) < 2) {
            return response()->json([]);
        }

        $response = Http::get("https://api.openweathermap.org/geo/1.0/direct", [
            'q' => $query,
            'limit' => 5, // Magpapakita ng hanggang 5 na suhestiyon
            'appid' => $apiKey
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json([], 500);
    }
}