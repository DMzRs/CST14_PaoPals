<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    use HasFactory;

    protected $table = 'stockout';

    protected $fillable = [
        'stockinId',
        'quantity',
        'dateUsed',
        'cause',
    ];

    // Cast date fields to proper types
    protected $casts = [
        'dateUsed' => 'datetime',
    ];

    // Relationship to StockIn
    public function stockin()
    {
        return $this->belongsTo(StockIn::class, 'stockinId');
    }
}
