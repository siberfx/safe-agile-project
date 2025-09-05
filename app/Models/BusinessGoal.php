<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusinessGoal extends Model
{
    protected $fillable = [
        'title',
        'description',
        'value_score',
        'quarter',
        'year',
        'status',
        'program_id',
        'target_date',
        'budget',
        'prognose',
    ];

    protected $casts = [
        'value_score' => 'integer',
        'year' => 'integer',
        'target_date' => 'date',
        'budget' => 'decimal:2',
        'prognose' => 'decimal:2',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function epics(): HasMany
    {
        return $this->hasMany(Epic::class);
    }

    public function userStories(): HasMany
    {
        return $this->hasMany(Task::class, 'business_goal_id');
    }

    public function testCases(): HasMany
    {
        return $this->hasMany(TestCase::class);
    }
}
