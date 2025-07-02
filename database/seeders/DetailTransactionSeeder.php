<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use App\Models\Inventory;
use App\Models\Category;

class DetailTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $transaction = Transaction::first();
        $inventory = Inventory::first();
        $category = Category::first();
        $details = [
            [
                'transaction_id' => $transaction ? $transaction->id : 1,
                'inventory_id' => $inventory ? $inventory->id : 1,
                'category_id' => $category ? $category->id : 1,
                'total' => 10,
                'unit_type' => 'kg',
            ],
            [
                'transaction_id' => $transaction ? $transaction->id : 1,
                'inventory_id' => $inventory ? $inventory->id : 1,
                'category_id' => $category ? $category->id : 1,
                'total' => 5,
                'unit_type' => 'liter',
            ],
        ];
        foreach ($details as $detail) {
            DetailTransaction::firstOrCreate($detail);
        }
    }
} 