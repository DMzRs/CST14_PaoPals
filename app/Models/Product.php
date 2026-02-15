<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Specify the table name since it's singular
    protected $table = 'product';

    // Fields that can be mass-assigned
    protected $fillable = [
        'productName',
        'productCategory',
        'productImage',
        'productPrice',
    ];

    public function stockIns()
    {
        return $this->hasMany(StockIn::class, 'productId');
    }
    
    // Optional: if you want to relate products to orders
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'productId'); 
        // assumes you add a productId foreign key in your order_items table
    }

    // Through StockIns, get all stockouts
    public function stockouts()
    {
        return $this->hasManyThrough(
            StockOut::class,  // Final model
            StockIn::class,   // Intermediate model
            'productId',      // Foreign key on StockIn
            'stockinId',      // Foreign key on StockOut
            'id',             // Local key on Product
            'id'              // Local key on StockIn
        );
    }
}
