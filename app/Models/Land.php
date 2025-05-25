<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Land extends Model
{
    use HasFactory;

    protected $fillable = ['land_name', 'location', 'total_plant', 'wide'];

    public $timestamps = false;

    public function plants()
    {
        return $this->hasMany(Plant::class);
    }
}

