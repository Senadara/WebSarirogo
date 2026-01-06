<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryNutrition extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'nutrient_name',
        'value',
        'unit',
    ];

    protected $casts = [
        'value' => 'decimal:2',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
