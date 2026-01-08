<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Core Tables
            RoleSeeder::class,
            UserSeeder::class,
            
            // Inventory Module
            CategorySeeder::class,
            SupplierSeeder::class,
            WarehouseSeeder::class,
            InventorySeeder::class,
            
            // Poultry Module
            CageSeeder::class,
            DailyChickenReportSeeder::class,
        ]);
    }
}
