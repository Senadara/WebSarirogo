<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cage;

class CageSeeder extends Seeder
{
    public function run(): void
    {
        $cages = [
            ['cage_name' => 'Kandang A', 'location' => 'Blok A', 'cage_category' => 'Ayam', 'total_life' => 10, 'total_dead' => 1],
            ['cage_name' => 'Kandang B', 'location' => 'Blok B', 'cage_category' => 'Kambing', 'total_life' => 5, 'total_dead' => 0],
        ];
        foreach ($cages as $cage) {
            Cage::firstOrCreate($cage);
        }
    }
} 