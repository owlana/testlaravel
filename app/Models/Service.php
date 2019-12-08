<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class)->withPivot('price');
    }
}
