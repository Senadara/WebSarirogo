<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'brand',
        'category_id',
        'warehouse_id',
        'type',
        'item_type',
        'stock',
        'initial_stock',
        'unit',
        'price',
        'min_stock',
        'daily_usage_estimate',
        'entry_date',
        'expiry_date',
        'last_restock_date',
        'image',
        'status',
        'notes',
    ];

    protected $casts = [
        'entry_date' => 'date',
        'expiry_date' => 'date',
        'last_restock_date' => 'datetime',
        'price' => 'decimal:2',
        'daily_usage_estimate' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function nutritions()
    {
        return $this->hasMany(InventoryNutrition::class);
    }

    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

    public function reportUsages()
    {
        return $this->hasMany(ReportInventoryUsage::class);
    }

    /**
     * Automatically update status based on stock level
     */
    public function updateStatus(): void
    {
        if ($this->stock <= 0) {
            $this->status = 'out_of_stock';
        } elseif ($this->stock <= $this->min_stock) {
            $this->status = 'low_stock';
        } else {
            $this->status = 'available';
        }
    }
}
