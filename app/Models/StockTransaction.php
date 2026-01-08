<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'supplier_id',
        'user_id',
        'transaction_type',
        'quantity',
        'stock_before',
        'stock_after',
        'transaction_date',
        'document_number',
        'total_price',
        'notes',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
