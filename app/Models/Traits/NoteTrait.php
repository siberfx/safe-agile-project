<?php

namespace App\Models\Traits;

use App\Models\Note;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait NoteTrait
{
    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'entity');
    }
}
