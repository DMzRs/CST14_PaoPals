<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    // Only needed if your table name is NOT activity_logs
    // protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'action',
        'description',
        'module',
        'record_id',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'record_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}