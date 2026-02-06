<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'orderitem';

    protected $fillable = [
        'orderId',
        'productId',
        'quantity',
        'unitPrice',
    ];

    // Relationship to Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'orderId');
    }

    // Relationship to Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}
