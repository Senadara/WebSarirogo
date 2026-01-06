<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyChickenReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'cage_id',
        'user_id',
        'report_date',
        'population_initial',
        'population_alive',
        'population_productive',
        'population_sick',
        'population_culled',
        'eggs_produced',
        'eggs_weight_total',
        'eggs_weight_avg',
        'feed_consumed',
        'mortality_count',
        'mortality_cause',
        'fcr',
        'hdp',
        'hhep',
        'activity_type',
        'image',
        'notes'
    ];

    protected $casts = [
        'report_date' => 'date',
        'eggs_weight_total' => 'decimal:2',
        'eggs_weight_avg' => 'decimal:2',
        'feed_consumed' => 'decimal:2',
        'fcr' => 'decimal:3',
        'hdp' => 'decimal:2',
        'hhep' => 'decimal:2',
    ];

    public function cage()
    {
        return $this->belongsTo(Cage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inventoryUsages()
    {
        return $this->hasMany(ReportInventoryUsage::class);
    }

    /**
     * Calculate FCR: Feed / Egg Weight
     */
    public function calculateFcr(): ?float
    {
        if ($this->eggs_weight_total > 0) {
            return round($this->feed_consumed / $this->eggs_weight_total, 3);
        }
        return null;
    }

    /**
     * Calculate HDP: (Eggs / Alive Chickens) * 100
     */
    public function calculateHdp(): ?float
    {
        if ($this->population_alive > 0) {
            return round(($this->eggs_produced / $this->population_alive) * 100, 2);
        }
        return null;
    }

    /**
     * Calculate HHEP: (Eggs / Initial Population) * 100
     */
    public function calculateHhep(): ?float
    {
        if ($this->population_initial > 0) {
            return round(($this->eggs_produced / $this->population_initial) * 100, 2);
        }
        return null;
    }

    /**
     * Auto-calculate metrics before saving
     */
    protected static function booted()
    {
        static::saving(function ($report) {
            $report->fcr = $report->calculateFcr();
            $report->hdp = $report->calculateHdp();
            $report->hhep = $report->calculateHhep();
        });
    }

    public function scopeOnDate($query, $date)
    {
        return $query->whereDate('report_date', $date);
    }

    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('report_date', [$startDate, $endDate]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('report_date', now()->month)
                     ->whereYear('report_date', now()->year);
    }
}
