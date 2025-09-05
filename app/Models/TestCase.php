<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestCase extends Model
{
    protected $fillable = [
        'title',
        'description',
        'expected_result',
        'actual_result',
        'status',
        'business_goal_id',
        'feature_id',
        'user_story_id',
        'tester_id',
        'test_date',
    ];

    protected $casts = [
        'test_date' => 'datetime',
    ];

    public function businessGoal(): BelongsTo
    {
        return $this->belongsTo(BusinessGoal::class);
    }

    public function feature(): BelongsTo
    {
        return $this->belongsTo(Feature::class);
    }

    public function userStory(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'user_story_id');
    }

    public function tester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tester_id');
    }
}
