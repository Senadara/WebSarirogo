<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'PT Pakan Jaya Indonesia',
                'contact_person' => 'Budi Santoso',
                'phone' => '031-5551234',
                'email' => 'sales@pakanjaya.co.id',
                'address' => 'Jl. Raya Industri No. 45, Surabaya',
                'status' => 'active',
            ],
            [
                'name' => 'CV Agro Kimia Mandiri',
                'contact_person' => 'Siti Rahayu',
                'phone' => '031-5559876',
                'email' => 'info@agrokimia.com',
                'address' => 'Jl. Ngagel Rejo No. 88, Surabaya',
                'status' => 'active',
            ],
            [
                'name' => 'UD Ternak Sejahtera',
                'contact_person' => 'Ahmad Wijaya',
                'phone' => '081234567890',
                'email' => 'ternak.sejahtera@gmail.com',
                'address' => 'Jl. Sarirogo No. 12, Sidoarjo',
                'status' => 'active',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
