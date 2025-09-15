<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\Animal;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $ayamAnimal = Animal::where('category_id', 2)->where('status', 'Alive')->first();
        $kambingAnimal = Animal::where('category_id', 3)->where('status', 'Alive')->first();

        $reports = [
            
            [
                'animal_id' => $ayamAnimal?->id ?? 1,
                'source' => 'growth',
                'title' => 'Pertumbuhan Ayam',
                'date' => now(),
                'note' => 'Ayam bertambah berat',
                'image' => null,
                'previous_weight' => 2.1,
                'current_weight' => 2.5,
            ],
            [
                'animal_id' => $ayamAnimal?->id ?? 1,
                'source' => 'dead',
                'title' => 'Ayam Mati',
                'date' => now()->subDays(1),
                'note' => 'Mati karena cuaca',
                'image' => null,
                'previous_weight' => 2.5,
                'current_weight' => 2.5,
            ],
            [
                'animal_id' => $kambingAnimal?->id ?? 2,
                'source' => 'new',
                'title' => 'Kambing Baru Lahir',
                'date' => now()->subDays(3),
                'note' => 'Anak kambing lahir',
                'image' => null,
                'previous_weight' => 0,
                'current_weight' => 1.0,
            ],
        ];

        foreach ($reports as $report) {
            Report::firstOrCreate($report);
        }
    }
} 