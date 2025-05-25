<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cage extends Model
{
    use HasFactory;

    protected $fillable = ['cage_name', 'location', 'cage_category', 'total_life', 'total_dead'];

    public $timestamps = false;

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}

