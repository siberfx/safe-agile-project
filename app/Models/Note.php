<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @mixin IdeHelperNote
 */
class Note extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'body',
        'user_id',
        'entity_type',
        'entity_id',
    ];

    /**
     * Get the entity that the note belongs to (polymorphic relationship).
     */
    public function entity(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user that created the note.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
