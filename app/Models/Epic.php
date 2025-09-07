<?php

namespace App\Models;

use App\Models\Traits\NoteTrait;
use App\Models\Traits\TenantAware;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperEpic
 */
class Epic extends Model
{
    use NoteTrait, TenantAware;

    protected $fillable = [
        'title',
        'description',
        'business_goal_id',
        'priority',
        'expected_value',
        'status',
        'story_points',
        'target_date',
    ];

    protected $casts = [
        'expected_value' => 'decimal:2',
        'target_date' => 'date',
    ];

    public function businessGoal(): BelongsTo
    {
        return $this->belongsTo(BusinessGoal::class);
    }

    public function features(): HasMany
    {
        return $this->hasMany(Feature::class);
    }

    public function userStories(): HasMany
    {
        return $this->hasMany(Task::class, 'epic_id');
    }
}
