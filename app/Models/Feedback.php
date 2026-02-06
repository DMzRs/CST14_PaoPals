<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'userId',
        'message',
        'createdAt', // optional if you keep it
    ];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
