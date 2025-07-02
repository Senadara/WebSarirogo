<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            LandSeeder::class,
            CageSeeder::class,
            InventorySeeder::class,
            PlantSeeder::class,
            AnimalSeeder::class,
            ReportSeeder::class,
            TransactionSeeder::class,
            DetailTransactionSeeder::class,
            LogTransactionSeeder::class,
            LogSeeder::class,
        ]);

        DB::table('categories')->insert([
            'name_category' => 'Okra',
            'price' => 1000.00, // harga per satuan
        ]);

    }
}
