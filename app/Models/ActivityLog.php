<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ActivityLog extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'action',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($activityLog) {
            if (!app()->runningInConsole()) {
                $activityLog->ip_address = $activityLog->ip_address ?? request()->ip();
                $activityLog->user_agent = $activityLog->user_agent ?? Str::limit(request()->userAgent(), 512, '');
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
