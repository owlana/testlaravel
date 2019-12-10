<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * The timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Belongs To relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function intervalSchedule()
    {
        return $this->belongsTo(IntervalSchedule::class);
    }

    /**
     * Has One relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
