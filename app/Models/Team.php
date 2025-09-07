<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin IdeHelperTeam
 */
class Team extends Model
{
    protected $fillable = [
        'name',
        'description',
        'tenant_id',
        'is_active',
        'settings',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings' => 'array',
    ];

    /**
     * Get the tenant that owns the team.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Users that belong to this team.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_teams')
            ->withPivot(['role', 'is_active'])
            ->withTimestamps()
            ->wherePivot('is_active', true);
    }

    /**
     * Get landlord users of this team.
     */
    public function landlords(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_teams')
            ->withPivot(['role', 'is_active'])
            ->withTimestamps()
            ->wherePivot('role', 'landlord')
            ->wherePivot('is_active', true);
    }

    /**
     * Get member users of this team.
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_teams')
            ->withPivot(['role', 'is_active'])
            ->withTimestamps()
            ->wherePivot('role', 'member')
            ->wherePivot('is_active', true);
    }

    /**
     * Get admin users of this team.
     */
    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_teams')
            ->withPivot(['role', 'is_active'])
            ->withTimestamps()
            ->wherePivot('role', 'admin')
            ->wherePivot('is_active', true);
    }

    /**
     * Scope to filter active teams.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to filter by tenant.
     */
    public function scopeForTenant($query, $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }
}
