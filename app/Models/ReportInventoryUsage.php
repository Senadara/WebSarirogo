<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportInventoryUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'daily_chicken_report_id',
        'inventory_id',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
    ];

    public function dailyChickenReport()
    {
        return $this->belongsTo(DailyChickenReport::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
