<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    private string $baseUrl = 'https://api.bmkg.go.id/publik/prakiraan-cuaca';
    private string $regionCode;
    private int $cacheDuration = 1800; // 30 minutes in seconds

    public function __construct()
    {
        $this->regionCode = config('services.bmkg.region_code', '35.15.08.2023');
    }

    /**
     * Get weather forecast from BMKG API
     * 
     * @return array
     */
    public function getForecast(): array
    {
        return Cache::remember('bmkg_weather_forecast', $this->cacheDuration, function () {
            try {
                $response = Http::timeout(10)->get($this->baseUrl, [
                    'adm4' => $this->regionCode
                ]);

                if ($response->successful()) {
                    return $this->parseResponse($response->json());
                }

                Log::warning('BMKG API returned non-success status', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return $this->getDefaultData();
            } catch (\Exception $e) {
                Log::error('BMKG API error', ['error' => $e->getMessage()]);
                return $this->getDefaultData();
            }
        });
    }

    /**
     * Parse BMKG API response
     */
    private function parseResponse(array $data): array
    {
        $forecasts = $data['data'][0]['cuaca'] ?? [];
        $allForecasts = [];

        // Flatten all forecast arrays
        foreach ($forecasts as $dayForecasts) {
            foreach ($dayForecasts as $forecast) {
                $allForecasts[] = $forecast;
            }
        }

        // Sort by datetime
        usort($allForecasts, function ($a, $b) {
            return strtotime($a['local_datetime']) - strtotime($b['local_datetime']);
        });

        // Get current time
        $now = now();
        $currentHour = $now->format('H');

        // Find current/closest forecast
        $current = null;
        $upcoming = [];

        foreach ($allForecasts as $forecast) {
            $forecastTime = \Carbon\Carbon::parse($forecast['local_datetime']);
            
            if ($forecastTime <= $now && (!$current || $forecastTime > \Carbon\Carbon::parse($current['local_datetime']))) {
                $current = $forecast;
            }
            
            if ($forecastTime > $now && count($upcoming) < 6) {
                $upcoming[] = $forecast;
            }
        }

        // Use first forecast if no current found
        if (!$current && !empty($allForecasts)) {
            $current = $allForecasts[0];
        }

        return [
            'location' => $data['lokasi']['desa'] ?? 'Sarirogo',
            'last_update' => now()->format('H:i'),
            'current' => $current ? $this->formatForecast($current) : $this->getDefaultCurrent(),
            'forecast' => array_map([$this, 'formatForecast'], $upcoming),
        ];
    }

    /**
     * Format single forecast data
     */
    private function formatForecast(array $forecast): array
    {
        return [
            'time' => \Carbon\Carbon::parse($forecast['local_datetime'])->format('H:i'),
            'date' => \Carbon\Carbon::parse($forecast['local_datetime'])->format('d M'),
            'temperature' => round($forecast['t'] ?? 28),
            'humidity' => round($forecast['hu'] ?? 65),
            'description' => $forecast['weather_desc'] ?? 'Cerah',
            'description_en' => $forecast['weather_desc_en'] ?? 'Clear',
            'wind_speed' => round($forecast['ws'] ?? 10),
            'wind_direction' => $forecast['wd'] ?? 'N',
            'cloud_cover' => $forecast['tcc'] ?? 0,
            'weather_code' => $forecast['weather'] ?? 0,
            'icon' => $this->getWeatherIcon($forecast['weather'] ?? 0),
        ];
    }

    /**
     * Get weather icon based on BMKG weather code
     */
    private function getWeatherIcon(int $code): string
    {
        // BMKG weather codes
        $icons = [
            0 => 'cerah',           // Cerah
            1 => 'cerah-berawan',   // Cerah Berawan
            2 => 'cerah-berawan',   // Cerah Berawan
            3 => 'berawan',         // Berawan
            4 => 'berawan-tebal',   // Berawan Tebal
            5 => 'hujan-ringan',    // Udara Kabur
            10 => 'asap',           // Asap
            45 => 'kabut',          // Kabut
            60 => 'hujan-ringan',   // Hujan Ringan
            61 => 'hujan-sedang',   // Hujan Sedang
            63 => 'hujan-lebat',    // Hujan Lebat
            80 => 'hujan-lokal',    // Hujan Lokal
            95 => 'petir',          // Hujan Petir
            97 => 'petir',          // Hujan Petir
        ];

        return $icons[$code] ?? 'cerah';
    }

    /**
     * Default data when API fails
     */
    private function getDefaultData(): array
    {
        return [
            'location' => 'Sarirogo',
            'last_update' => now()->format('H:i'),
            'current' => $this->getDefaultCurrent(),
            'forecast' => [],
            'error' => true
        ];
    }

    /**
     * Default current weather
     */
    private function getDefaultCurrent(): array
    {
        return [
            'time' => now()->format('H:i'),
            'date' => now()->format('d M'),
            'temperature' => 28,
            'humidity' => 65,
            'description' => 'Data tidak tersedia',
            'description_en' => 'Data unavailable',
            'wind_speed' => 0,
            'wind_direction' => '-',
            'cloud_cover' => 0,
            'weather_code' => 0,
            'icon' => 'cerah',
        ];
    }

    /**
     * Clear weather cache
     */
    public function clearCache(): void
    {
        Cache::forget('bmkg_weather_forecast');
    }
}
