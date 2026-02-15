<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'orderId',
        'paymentId',
        'userId',
        'saleDate',
        'totalRevenue',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class, 'orderId');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'paymentId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
