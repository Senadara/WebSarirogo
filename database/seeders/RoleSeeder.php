<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'petugas_ayam',
            'petugas_kambing',
            'petugas_ikan',
            'petugas_okra',
            'petugas_inventory',
            'admin',
        ];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['role_name' => $roleName]);
        }
    }
} 