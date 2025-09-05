<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sprint extends Model
{
    protected $fillable = [
        'name',
        'sprint_number',
        'project_id',
        'start_date',
        'end_date',
        'planned_story_points',
        'completed_story_points',
        'completion_percentage',
        'status',
        'goals',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'completion_percentage' => 'decimal:2',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function userStories(): HasMany
    {
        return $this->hasMany(Task::class, 'sprint_id');
    }

    public function bugs(): HasMany
    {
        return $this->hasMany(Bug::class);
    }
}
