<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Animal;
use App\Models\Cage;
use App\Models\Category;

class AnimalSeeder extends Seeder
{
    public function run(): void
    {
        // $cage = Cage::first();

        $cageAyam = Cage::where('cage_category', 'ayam')->first();
        $cageKambing = Cage::where('cage_category', 'kambing')->first();

        $ayam = Category::where('name_category', 'Ayam')->first();
        $kambing = Category::where('name_category', 'Kambing')->first();
        
        $animals = [
            [
                'cage_id' => $cageAyam?->id,
                'category_id' => $ayam?->id,
                'entry_date' => now()->subDays(5),
                'expiry_date' => now()->addMonths(1),
                'weight' => 2.1,
                'status' => 'Alive',
            ],
            [
                'cage_id' => $cageKambing?->id,
                'category_id' => $kambing?->id,
                'entry_date' => now()->subDays(10),
                'expiry_date' => now()->addMonths(2),
                'weight' => 4.9,
                'status' => 'Alive',
            ],
            [
                'cage_id' => $cageAyam?->id,
                'category_id' => $ayam?->id,
                'entry_date' => now()->subDays(15),
                'expiry_date' => now()->addMonths(3),
                'weight' => 2.0,
                'status' => 'Dead',
            ],
        ];

        foreach ($animals as $animal) {
            if ($animal['cage_id'] && $animal['category_id']) {
                Animal::firstOrCreate($animal);
            }
        }
    }
} 