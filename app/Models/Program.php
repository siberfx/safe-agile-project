<?php

namespace App\Models;

use App\Models\Traits\NoteTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperProgram
 */
class Program extends Model
{
    use NoteTrait;

    protected $fillable = [
        'title',
        'description',
        'strategic_goals',
        'business_value',
        'owner',
        'status',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'business_value' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function businessGoals(): HasMany
    {
        return $this->hasMany(BusinessGoal::class);
    }
}
