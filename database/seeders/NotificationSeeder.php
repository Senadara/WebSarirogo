<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        if (!$user) return;

        $types = [
            ['title' => 'Stok Pakan Menipis', 'message' => 'Stok pakan Jagung sisa 50kg. Segera restock!', 'type' => 'danger'],
            ['title' => 'Produksi Telur Turun', 'message' => 'Produksi Kandang A turun 5% hari ini.', 'type' => 'warning'],
            ['title' => 'Laporan Harian Selesai', 'message' => 'Laporan harian semua kandang telah diinput.', 'type' => 'success'],
            ['title' => 'Ayam Sakit Terdeteksi', 'message' => 'Ada 2 ekor ayam sakit di Kandang B.', 'type' => 'danger'],
            ['title' => 'Jadwal Vaksinasi', 'message' => 'Besok jadwal vaksinasi ND-IB untuk Kandang C.', 'type' => 'info'],
        ];

        for ($i = 0; $i < 20; $i++) {
            $data = $types[array_rand($types)];
            DB::table('notifications')->insert([
                'id' => Str::uuid(),
                'type' => 'App\Notifications\SystemNotification',
                'notifiable_type' => 'App\Models\User',
                'notifiable_id' => $user->id,
                'data' => json_encode([
                    'title' => $data['title'],
                    'message' => $data['message'],
                    'type' => $data['type'],
                    'created_at' => now()->subHours($i * 2)->toDateTimeString()
                ]),
                'read_at' => $i < 5 ? null : now()->subHours($i), // First 5 unread
                'created_at' => now()->subHours($i * 2),
                'updated_at' => now()->subHours($i * 2),
            ]);
        }
    }
}
