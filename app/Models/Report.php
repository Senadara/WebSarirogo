<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'source',
        'title',
        'date',
        'note',
        'image',
        'previous_weight',
        'current_weight'
    ];

    public $timestamps = false;

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}

