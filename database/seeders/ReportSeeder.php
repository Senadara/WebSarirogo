<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\Animal;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $animal = Animal::first();
        $reports = [
            [
                'animal_id' => $animal ? $animal->id : 1,
                'source' => 'petugas',
                'title' => 'Laporan Berat',
                'date' => now(),
                'note' => 'Berat naik',
                'image' => null,
                'previous_weight' => 2.5,
                'current_weight' => 2.7,
            ],
            [
                'animal_id' => $animal ? $animal->id : 1,
                'source' => 'petugas',
                'title' => 'Laporan Kesehatan',
                'date' => now()->subDays(2),
                'note' => 'Sakit ringan',
                'image' => null,
                'previous_weight' => 2.7,
                'current_weight' => 2.6,
            ],
        ];
        foreach ($reports as $report) {
            Report::firstOrCreate($report);
        }
    }
} 