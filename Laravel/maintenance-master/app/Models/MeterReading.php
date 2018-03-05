<?php

namespace App\Models;

use App\Models\Traits\HasUserTrait;
use App\Viewers\MeterReadingViewer;

class MeterReading extends Model
{
    use HasUserTrait;

    /**
     * The meter readings table.
     *
     * @var string
     */
    protected $table = 'meter_readings';

    /**
     * The meter reading viewer.
     *
     * @var string
     */
    protected $viewer = MeterReadingViewer::class;

    /**
     * The fillable meter reading attributes.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'meter_id',
        'reading',
        'comment',
    ];

    /**
     * The belongsTo meter relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meter()
    {
        return $this->belongsTo(Meter::class, 'meter_id');
    }

    /**
     * Accessor for retrieving the current meter reading
     * with it's metric symbol. For example: '120.00 Gal'.
     *
     * @return string
     */
    public function getReadingWithMetricAttribute()
    {
        if ($this->meter && $this->meter->metric) {
            return $this->reading.' '.$this->meter->metric->symbol;
        }

        return $this->reading;
    }
}
