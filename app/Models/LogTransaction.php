<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'previous_profit',
        'current_profit',
    ];

    public $timestamps = false;

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}

