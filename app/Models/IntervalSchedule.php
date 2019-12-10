<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntervalSchedule extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'interval_schedule';

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
    public function interval()
    {
        return $this->belongsTo(Interval::class);
    }

    /**
     * Belongs To relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
