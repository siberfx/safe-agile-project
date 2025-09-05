<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Feature extends Model
{
    protected $fillable = [
        'title',
        'description',
        'epic_id',
        'pi',
        'sprint',
        'status',
        'story_points',
        'target_date',
    ];

    protected $casts = [
        'target_date' => 'date',
    ];

    public function epic(): BelongsTo
    {
        return $this->belongsTo(Epic::class);
    }

    public function userStories(): HasMany
    {
        return $this->hasMany(Task::class, 'feature_id');
    }

    public function testCases(): HasMany
    {
        return $this->hasMany(TestCase::class);
    }

    public function bugs(): HasMany
    {
        return $this->hasMany(Bug::class);
    }
}
