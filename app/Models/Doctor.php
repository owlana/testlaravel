<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    /**
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongToMany
     */
    public function specialities()
    {
        return $this->belongsToMany(Speciality::class);
    }
}
