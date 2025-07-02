<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Land;

class LandSeeder extends Seeder
{
    public function run(): void
    {
        $lands = [
            ['land_name' => 'Lahan 1', 'location' => 'Blok A', 'total_plant' => 10, 'wide' => 100],
            ['land_name' => 'Lahan 2', 'location' => 'Blok B', 'total_plant' => 20, 'wide' => 200],
        ];
        foreach ($lands as $land) {
            Land::firstOrCreate($land);
        }
    }
} 