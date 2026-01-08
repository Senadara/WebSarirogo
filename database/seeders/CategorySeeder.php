<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Pakan', 'description' => 'Pakan ternak dan tanaman'],
            ['name' => 'Pupuk', 'description' => 'Pupuk untuk tanaman'],
            ['name' => 'Bibit', 'description' => 'Bibit tanaman dan ternak'],
            ['name' => 'Obat & Vitamin', 'description' => 'Obat dan vitamin untuk ternak'],
            ['name' => 'Peralatan', 'description' => 'Peralatan dan perlengkapan pertanian'],
            ['name' => 'Hasil Panen', 'description' => 'Hasil panen pertanian dan peternakan'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}