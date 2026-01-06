<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cage;

class CageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cages = [
            [
                'name' => 'Kandang A',
                'cage_type' => 'Postal',
                'location' => 'Area Depan',
                'chicken_type' => 'Layer',
                'capacity' => 1500,
                'initial_population' => 1200,
                'current_population' => 1180,
                'age_days' => 150,
                'phase' => 'production',
                'installed_date' => now()->subMonths(8),
                'chick_in_date' => now()->subDays(150),
                'status' => 'active',
            ],
            [
                'name' => 'Kandang B',
                'cage_type' => 'Postal',
                'location' => 'Area Tengah',
                'chicken_type' => 'Layer',
                'capacity' => 1500,
                'initial_population' => 1100,
                'current_population' => 1085,
                'age_days' => 90,
                'phase' => 'grower',
                'installed_date' => now()->subMonths(6),
                'chick_in_date' => now()->subDays(90),
                'status' => 'active',
            ],
            [
                'name' => 'Kandang C',
                'cage_type' => 'Battery',
                'location' => 'Area Belakang',
                'chicken_type' => 'Layer',
                'capacity' => 1000,
                'initial_population' => 800,
                'current_population' => 795,
                'age_days' => 35,
                'phase' => 'starter',
                'installed_date' => now()->subMonths(4),
                'chick_in_date' => now()->subDays(35),
                'status' => 'active',
            ],
            [
                'name' => 'Kandang D',
                'cage_type' => 'Postal',
                'location' => 'Area Samping',
                'chicken_type' => 'Layer',
                'capacity' => 1200,
                'initial_population' => 1000,
                'current_population' => 450,
                'age_days' => 540,
                'phase' => 'culled',
                'installed_date' => now()->subYears(2),
                'chick_in_date' => now()->subDays(540),
                'status' => 'active',
            ],
        ];

        foreach ($cages as $cage) {
            Cage::create($cage);
        }
    }
}