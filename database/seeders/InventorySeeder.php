<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\Warehouse;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get category and warehouse IDs
        $categories = Category::pluck('id', 'name')->toArray();
        $warehouses = Warehouse::pluck('id', 'name')->toArray();

        $items = [
            [
                'name' => 'Pelet Ayam Petelur',
                'sku' => 'FEED-001',
                'brand' => 'Pokphand',
                'category_id' => $categories['Pakan'],
                'warehouse_id' => $warehouses['Gudang A'],
                'type' => 'supplies',
                'item_type' => 'consumable',
                'stock' => 5000,
                'initial_stock' => 5000,
                'unit' => 'kg',
                'price' => 8500,
                'min_stock' => 1000,
                'daily_usage_estimate' => 150,
                'status' => 'available',
            ],
            [
                'name' => 'Jagung Giling',
                'sku' => 'FEED-002',
                'brand' => 'Lokal',
                'category_id' => $categories['Pakan'],
                'warehouse_id' => $warehouses['Gudang A'],
                'type' => 'supplies',
                'item_type' => 'consumable',
                'stock' => 2000,
                'initial_stock' => 2000,
                'unit' => 'kg',
                'price' => 6000,
                'min_stock' => 500,
                'daily_usage_estimate' => 50,
                'status' => 'available',
            ],
            [
                'name' => 'Vaksin ND',
                'sku' => 'MED-001',
                'brand' => 'Medion',
                'category_id' => $categories['Obat & Vitamin'],
                'warehouse_id' => $warehouses['Gudang B'],
                'type' => 'supplies',
                'item_type' => 'consumable',
                'stock' => 50,
                'initial_stock' => 50,
                'unit' => 'botol',
                'price' => 150000,
                'min_stock' => 10,
                'expiry_date' => now()->addMonths(6),
                'status' => 'available',
            ],
            [
                'name' => 'Vitamin Egg Stimulant',
                'sku' => 'MED-002',
                'brand' => 'Star Farm',
                'category_id' => $categories['Obat & Vitamin'],
                'warehouse_id' => $warehouses['Gudang B'],
                'type' => 'supplies',
                'item_type' => 'consumable',
                'stock' => 100,
                'initial_stock' => 100,
                'unit' => 'sachet',
                'price' => 25000,
                'min_stock' => 20,
                'expiry_date' => now()->addMonths(12),
                'status' => 'available',
            ],
            [
                'name' => 'Desinfektan',
                'sku' => 'SUP-001',
                'brand' => 'Antisep',
                'category_id' => $categories['Peralatan'],
                'warehouse_id' => $warehouses['Gudang C'],
                'type' => 'supplies',
                'item_type' => 'consumable',
                'stock' => 20,
                'initial_stock' => 20,
                'unit' => 'jerigen',
                'price' => 200000,
                'min_stock' => 5,
                'status' => 'available',
            ],
            [
                'name' => 'Telur Ayam (Panen)',
                'sku' => 'HRV-001',
                'brand' => null,
                'category_id' => $categories['Hasil Panen'],
                'warehouse_id' => $warehouses['Gudang A'],
                'type' => 'harvest',
                'item_type' => 'consumable',
                'stock' => 150,
                'initial_stock' => 0,
                'unit' => 'kg',
                'price' => 28000,
                'min_stock' => 0,
                'status' => 'available',
            ],
            [
                'name' => 'Pupuk NPK',
                'sku' => 'FRT-001',
                'brand' => 'Phonska',
                'category_id' => $categories['Pupuk'],
                'warehouse_id' => $warehouses['Gudang A'],
                'type' => 'supplies',
                'item_type' => 'consumable',
                'stock' => 100,
                'initial_stock' => 100,
                'unit' => 'sak',
                'price' => 350000,
                'min_stock' => 20,
                'status' => 'available',
            ],
        ];

        foreach ($items as $item) {
            Inventory::create($item);
        }
    }
}