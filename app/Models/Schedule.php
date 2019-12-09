<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function intervals()
    {
        return $this->belongsToMany(Interval::class)->wherePivot('is_busy', false);
    }
}