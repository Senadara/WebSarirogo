<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;
use App\Models\Category;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::first();
        $inventories = [
            ['name' => 'Pakan Ayam', 'category_id' => $category ? $category->id : 1, 'total' => 100],
            ['name' => 'Obat Kambing', 'category_id' => $category ? $category->id : 1, 'total' => 50],
        ];
        foreach ($inventories as $inv) {
            Inventory::firstOrCreate($inv);
        }
    }
} 