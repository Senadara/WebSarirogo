<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plant;
use App\Models\Category;
use App\Models\Land;

class PlantSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::first();
        $land = Land::first();
        $plants = [
            [
                'category_id' => $category ? $category->id : 1,
                'land_id' => $land ? $land->id : 1,
                'total' => 100,
                'planting_date' => now(),
                'expiry_date' => now()->addMonths(3),
            ],
            [
                'category_id' => $category ? $category->id : 1,
                'land_id' => $land ? $land->id : 1,
                'total' => 50,
                'planting_date' => now()->subMonth(),
                'expiry_date' => now()->addMonths(2),
            ],
        ];
        foreach ($plants as $plant) {
            Plant::firstOrCreate($plant);
        }
    }
} 