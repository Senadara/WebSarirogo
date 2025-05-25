<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'inventory_id',
        'category_id',
        'total',
        'unit_type',
    ];

    public $timestamps = false;

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
