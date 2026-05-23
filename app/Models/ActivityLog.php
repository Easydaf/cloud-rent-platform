<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    // Activity logs table has created_at only (no updated_at)
    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'service',
        'action',
        'resource_type',
        'resource_id',
        'payload',
        'ip_address',
        'user_agent',
        'status',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->belongsTo(UserSubscription::class, 'subscription_id');
    }
}
