<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $transactions = [
            [
                'user_id' => $user ? $user->id : 1,
                'date' => now(),
                'type' => 'IN',
                'amount' => 100000,
                'image' => null,
            ],
            [
                'user_id' => $user ? $user->id : 1,
                'date' => now()->subDays(3),
                'type' => 'OUT',
                'amount' => 50000,
                'image' => null,
            ],
        ];
        foreach ($transactions as $trx) {
            Transaction::firstOrCreate($trx);
        }
    }
} 