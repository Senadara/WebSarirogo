<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cage_type',
        'location',
        'chicken_type',
        'capacity',
        'initial_population',
        'current_population',
        'age_days',
        'phase',
        'installed_date',
        'chick_in_date',
        'photo',
        'status',
    ];

    protected $casts = [
        'installed_date' => 'date',
        'chick_in_date' => 'date',
    ];

    public function dailyReports()
    {
        return $this->hasMany(DailyChickenReport::class);
    }

    /**
     * Get the latest daily report
     */
    public function latestReport()
    {
        return $this->hasOne(DailyChickenReport::class)->latestOfMany('report_date');
    }

    /**
     * Calculate age in weeks based on age_days
     */
    public function getAgeWeeksAttribute(): int
    {
        return (int) floor($this->age_days / 7);
    }

    /**
     * Get phase label in Indonesian
     */
    public function getPhaseLabelAttribute(): string
    {
        return match($this->phase) {
            'starter' => 'Starter',
            'grower' => 'Grower',
            'production' => 'Produksi',
            'culled' => 'Afkir',
            default => $this->phase,
        };
    }
}
