<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Log;
use App\Models\User;

class LogSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $logs = [
            [
                'user_id' => $user ? $user->id : 1,
                'timestamp' => now(),
                'activity' => 'Login',
                'note' => 'Berhasil login',
            ],
            [
                'user_id' => $user ? $user->id : 1,
                'timestamp' => now()->subDays(1),
                'activity' => 'Logout',
                'note' => 'Berhasil logout',
            ],
        ];
        foreach ($logs as $log) {
            Log::firstOrCreate($log);
        }
    }
} 