<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'project_id',
        'assigned_to',
        'status',
        'due_date',
        'priority',
        // Agile fields
        'sprint_id',
        'story_points',
        'acceptance_criteria',
        'agile_status',
        'feature_id',
        'epic_id',
        'business_goal_id',
        'priority_order',
        'definition_of_done',
    ];

    protected $casts = [
        'due_date' => 'date',
        'story_points' => 'integer',
        'priority_order' => 'integer',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function sprint(): BelongsTo
    {
        return $this->belongsTo(Sprint::class);
    }

    public function feature(): BelongsTo
    {
        return $this->belongsTo(Feature::class);
    }

    public function epic(): BelongsTo
    {
        return $this->belongsTo(Epic::class);
    }

    public function businessGoal(): BelongsTo
    {
        return $this->belongsTo(BusinessGoal::class);
    }

    public function testCases(): HasMany
    {
        return $this->hasMany(TestCase::class, 'user_story_id');
    }

    public function bugs(): HasMany
    {
        return $this->hasMany(Bug::class, 'user_story_id');
    }
}
