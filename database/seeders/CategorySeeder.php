<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name_category' => 'Okra', 'price' => 1000, 'unit' => 'Kg'],
            ['name_category' => 'Ayam', 'price' => 2000, 'unit' => 'Ekor'],
            ['name_category' => 'Kambing', 'price' => 3000, 'unit' => 'Ekor'],
        ];
        foreach ($categories as $cat) {
            Category::firstOrCreate($cat);
        }
    }
} 