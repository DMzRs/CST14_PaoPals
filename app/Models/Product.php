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

    // Optional: if you want to relate products to orders
    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id'); 
        // assumes you add a product_id foreign key in your orders table
    }
}
