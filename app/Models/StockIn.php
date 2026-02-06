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

    // Relationship to Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}
