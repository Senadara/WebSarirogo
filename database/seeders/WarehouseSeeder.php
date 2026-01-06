<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warehouses = [
            [
                'name' => 'Gudang A',
                'location' => 'Area Depan',
                'description' => 'Gudang utama untuk pakan dan pupuk',
                'status' => 'active',
            ],
            [
                'name' => 'Gudang B',
                'location' => 'Area Belakang',
                'description' => 'Gudang penyimpanan obat dan vitamin',
                'status' => 'active',
            ],
            [
                'name' => 'Gudang C',
                'location' => 'Area Samping',
                'description' => 'Gudang peralatan dan perlengkapan',
                'status' => 'active',
            ],
            [
                'name' => 'Rak Penyimpanan',
                'location' => 'Dalam Kantor',
                'description' => 'Rak untuk barang-barang kecil',
                'status' => 'active',
            ],
        ];

        foreach ($warehouses as $warehouse) {
            Warehouse::create($warehouse);
        }
    }
}
