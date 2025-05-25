<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'cage_id',
        'category_id',
        'entry_date',
        'expiry_date',
        'weight',
        'status'
    ];

    public $timestamps = false;

    public function cage()
    {
        return $this->belongsTo(Cage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}

