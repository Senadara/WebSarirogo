<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name_category' => 'Okra', 'price' => 1000],
            ['name_category' => 'Ayam', 'price' => 2000],
            ['name_category' => 'Kambing', 'price' => 3000],
        ];
        foreach ($categories as $cat) {
            Category::firstOrCreate($cat);
        }
    }
} 