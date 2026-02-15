<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Table name (optional if it matches Laravel's plural convention)
    protected $table = 'order';

    // Fillable fields for mass assignment
    protected $fillable = [
        'userId',
        'orderDate',
        'orderStatus',
    ];

    // If you want to use the foreign key relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'orderId');
    }
}
