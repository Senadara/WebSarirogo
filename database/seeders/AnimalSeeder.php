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
        $cage = Cage::first();
        $category = Category::first();
        $animals = [
            [
                'cage_id' => $cage ? $cage->id : 1,
                'category_id' => $category ? $category->id : 1,
                'entry_date' => now()->subDays(10),
                'expiry_date' => now()->addMonths(1),
                'weight' => 2.5,
                'status' => 'Alive',
            ],
            [
                'cage_id' => $cage ? $cage->id : 1,
                'category_id' => $category ? $category->id : 1,
                'entry_date' => now()->subDays(20),
                'expiry_date' => now()->addMonths(2),
                'weight' => 3.1,
                'status' => 'Dead',
            ],
        ];
        foreach ($animals as $animal) {
            Animal::firstOrCreate($animal);
        }
    }
} 