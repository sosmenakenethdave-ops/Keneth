<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // 1. Auto-redirect papunta sa role-specific URL kapag nag-access sa generic na /dashboard
        if ($request->is('dashboard')) {
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'staff') {
                return redirect()->route('staff.dashboard');
            } elseif ($user->role === 'cashier') {
                return redirect()->route('cashier.dashboard');
            }
        }

        $weatherData = null;
        $weatherError = null;

        // 2. I-fetch lamang ang Weather API kapag Admin
        if ($user->role === 'admin') {
            try {
                $apiKey = config('services.openweather.key');
                $city = config('services.openweather.city', 'Manila');

                $response = Http::timeout(4)->get('https://api.openweathermap.org/data/2.5/weather', [
                    'q' => $city,
                    'appid' => $apiKey,
                    'units' => 'metric',
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    
                    $weatherData = [
                        'city' => $data['name'] ?? $city,
                        'temperature' => round($data['main']['temp'] ?? 0, 1),
                        'humidity' => $data['main']['humidity'] ?? 'N/A',
                        'wind_speed' => $data['wind']['speed'] ?? 'N/A',
                        'condition' => ucfirst($data['weather'][0]['description'] ?? 'N/A'),
                    ];
                } else {
                    $weatherError = 'Hindi ma-fetch ang weather data. Siguraduhing tama at active na ang iyong OpenWeather API key.';
                }
            } catch (\Exception $e) {
                Log::error('OpenWeather API Error: ' . $e->getMessage());
                $weatherError = 'Hindi maabot ang Weather API service (Timeout/Connection Error).';
            }
        }

        return view('dashboard', compact('weatherData', 'weatherError'));
    }
}