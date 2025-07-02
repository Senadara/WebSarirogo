<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LogTransaction;
use App\Models\Transaction;

class LogTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $transaction = Transaction::first();
        $logs = [
            [
                'transaction_id' => $transaction ? $transaction->id : 1,
                'previous_profit' => 10000,
                'current_profit' => 15000,
            ],
            [
                'transaction_id' => $transaction ? $transaction->id : 1,
                'previous_profit' => 15000,
                'current_profit' => 20000,
            ],
        ];
        foreach ($logs as $log) {
            LogTransaction::firstOrCreate($log);
        }
    }
} 