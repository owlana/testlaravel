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
     * Has One relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function schedule()
    {
        return $this->hasOneThrough(Schedule::class, IntervalSchedule::class);
    }

    /**
     * Has One relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function interval()
    {
        return $this->hasOneThrough(Interval::class, IntervalSchedule::class);
    }
}
