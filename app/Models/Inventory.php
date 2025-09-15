<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'total', 'expiry_date'];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function dailyUsages()
    {
        return $this->hasMany(\App\Models\DailyUsage::class);
    }

    // public function restockInventories()
    // {
    //     return $this->hasMany(\App\Models\RestockInventory::class);
    // }
}
