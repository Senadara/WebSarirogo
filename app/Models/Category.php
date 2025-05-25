<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name_category', 'price'];

    public $timestamps = false;

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }

    public function plants()
    {
        return $this->hasMany(Plant::class);
    }
}

