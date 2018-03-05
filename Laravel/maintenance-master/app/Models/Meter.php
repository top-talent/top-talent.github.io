<?php

namespace App\Models;

use App\Models\Traits\HasUserTrait;
use App\Viewers\MeterViewer;

class Meter extends Model
{
    use HasUserTrait;

    /**
     * The meter table.
     *
     * @var string
     */
    protected $table = 'meters';

    /**
     * The meter viewer.
     *
     * @var string
     */
    protected $viewer = MeterViewer::class;

    /**
     * The fillable meter attributes.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'metric_id',
        'name',
    ];

    /**
     * The hasOne meter relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function metric()
    {
        return $this->hasOne(Metric::class, 'id', 'metric_id');
    }

    /**
     * The hasMany readings relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function readings()
    {
        return $this->hasMany(MeterReading::class, 'meter_id')->latest();
    }

    /**
     * The belongsToMany assets relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assets()
    {
        return $this->belongsToMany(Asset::class, 'asset_meters', 'meter_id', 'asset_id');
    }

    /**
     * Returns the last meter reading.
     *
     * @return null|MeterReading
     */
    public function getLastReading()
    {
        return $this->readings->first();
    }

    /**
     * Returns the last reading amount.
     *
     * @return null|string
     */
    public function getLastReadingAttribute()
    {
        $reading = $this->getLastReading();

        if ($reading) {
            return $reading->reading;
        }

        return;
    }

    /**
     * Returns the last reading amount with its metric symbol.
     *
     * @return null|string
     */
    public function getLastReadingWithMetricAttribute()
    {
        $reading = $this->getLastReading();

        if ($reading) {
            return $reading->reading_with_metric;
        }

        return;
    }

    /**
     * Returns the last reading comment.
     *
     * @return null|string
     */
    public function getLastCommentAttribute()
    {
        $reading = $this->getLastReading();

        if ($reading) {
            return $reading->comment;
        }

        return;
    }
}
