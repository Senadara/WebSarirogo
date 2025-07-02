<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
                'petugas_ayam',
                'petugas_kambing',
                'petugas_ikan',
                'petugas_okra',
                'petugas_inventory',
                'admin'
        ];

        foreach ($roles as $roleName) {
            $role = Role::firstOrCreate(['role_name' => $roleName]);

            User::firstOrCreate([
                'username' => str_replace(' ', '_', $roleName),
            ], [
                'email' => $roleName . '@gmail.com',
                'password' => Hash::make('password'),
                'name' => ucfirst($roleName),
                'role_id' => $role->id,
            ]);
        }
    }
}
