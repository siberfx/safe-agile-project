<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Contact extends Model
{
    use LogsActivity;

    protected $fillable = [
        'display_name',
        'email',
        'phone',
        'moneybird_contact_id',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['display_name', 'email', 'phone', 'moneybird_contact_id'])
            ->logOnlyDirty();
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function dnsZones(): HasMany
    {
        return $this->hasMany(DnsZone::class);
    }

    public function getActiveServicesAttribute()
    {
        return $this->services()->where('state', 'active')->get();
    }

    public function getDedicatedIpsAttribute()
    {
        return $this->services()
            ->where('ip_policy', 'dedicated')
            ->with('assignments.ipAddress')
            ->get()
            ->pluck('assignments')
            ->flatten()
            ->pluck('ipAddress')
            ->filter();
    }
}
