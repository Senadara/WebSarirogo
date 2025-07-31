<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyUsage extends Model
{
    use HasFactory;
    protected $fillable = ['inventory_id', 'quantity_used', 'used_at', 'notes'];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    // Hook: setelah record dibuat, kurangi stok
    protected static function booted()
    {
        static::created(function (DailyUsage $usage) {
            $usage->inventory->decrement('total', $usage->quantity_used);
        });
    }
}
