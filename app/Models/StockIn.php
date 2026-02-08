<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    use HasFactory;

    protected $table = 'stockin';

    protected $fillable = [
        'productId',
        'quantity',
        'dateCreated',
        'expirationDate',
        'remainingStock',
        'status',
    ];

    // Cast date fields to proper types
    protected $casts = [
        'dateCreated' => 'datetime',
        'expirationDate' => 'date',
    ];

    // Relationship to Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }

    // Relationship to StockOuts
    public function stockouts()
    {
        return $this->hasMany(StockOut::class, 'stockinId');
    }
}
