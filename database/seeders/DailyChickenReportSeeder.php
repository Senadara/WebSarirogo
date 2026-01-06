<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DailyChickenReport;
use App\Models\Cage;
use App\Models\User;
use Carbon\Carbon;

class DailyChickenReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cages = Cage::all();
        $user = User::first();
        
        if ($cages->isEmpty()) {
            return;
        }

        foreach ($cages as $cage) {
            // Generate reports for the last 30 days
            for ($i = 29; $i >= 0; $i--) {
                $reportDate = Carbon::now()->subDays($i);
                
                // Skip if already exists
                if (DailyChickenReport::where('cage_id', $cage->id)
                    ->whereDate('report_date', $reportDate)
                    ->exists()) {
                    continue;
                }
                
                // Calculate population changes
                $dailyMortality = rand(0, 3);
                $dailyCulled = $cage->phase === 'culled' ? rand(5, 15) : 0;
                $populationAlive = max(0, $cage->current_population - ($dailyMortality * ($i + 1)));
                
                // Egg production based on phase
                $eggsProduced = 0;
                if ($cage->phase === 'production') {
                    $eggsProduced = (int)($populationAlive * (rand(70, 85) / 100));
                } elseif ($cage->phase === 'culled') {
                    $eggsProduced = (int)($populationAlive * (rand(30, 50) / 100));
                }
                
                $eggWeight = $eggsProduced * rand(55, 65) / 1000; // In kg
                
                // Feed consumption (approx 120g per chicken per day)
                $feedConsumed = $populationAlive * 0.12;

                DailyChickenReport::create([
                    'cage_id' => $cage->id,
                    'user_id' => $user?->id,
                    'report_date' => $reportDate,
                    'population_initial' => $cage->initial_population,
                    'population_alive' => $populationAlive,
                    'population_productive' => $cage->phase === 'production' ? (int)($populationAlive * 0.9) : 0,
                    'population_sick' => rand(0, 5),
                    'population_culled' => $dailyCulled,
                    'eggs_produced' => $eggsProduced,
                    'eggs_weight_total' => round($eggWeight, 2),
                    'eggs_weight_avg' => $eggsProduced > 0 ? round(($eggWeight * 1000) / $eggsProduced, 2) : null,
                    'feed_consumed' => round($feedConsumed, 2),
                    'mortality_count' => $dailyMortality,
                    'mortality_cause' => $dailyMortality > 0 ? ['Penyakit', 'Stres', 'Cuaca'][rand(0, 2)] : null,
                    'activity_type' => ['Pakan', 'Perawatan', 'Panen'][rand(0, 2)],
                    'notes' => 'Data harian otomatis dari seeder',
                ]);
            }
        }
    }
}
