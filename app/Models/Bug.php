<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperBug
 */
class Bug extends Model
{
    protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
        'user_story_id',
        'feature_id',
        'sprint_id',
        'reporter_id',
        'assignee_id',
        'steps_to_reproduce',
        'expected_behavior',
        'actual_behavior',
    ];

    public function userStory(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'user_story_id');
    }

    public function feature(): BelongsTo
    {
        return $this->belongsTo(Feature::class);
    }

    public function sprint(): BelongsTo
    {
        return $this->belongsTo(Sprint::class);
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }
}
