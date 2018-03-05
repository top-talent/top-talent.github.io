<?php

namespace App\Models;

use App\Models\Traits\HasLocationTrait;
use App\Models\Traits\HasUserTrait;
use App\Viewers\Event\EventViewer;

class Event extends Model
{
    use HasLocationTrait;
    use HasUserTrait;

    /**
     * The events table.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The fillable event attributes.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'parent_id',
        'api_id',
    ];

    /**
     * The event viewer.
     *
     * @var string
     */
    protected $viewer = EventViewer::class;

    /**
     * The hasOne report relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function report()
    {
        return $this->hasOne(EventReport::class, 'event_id');
    }

    /**
     * The belongsTo parent event relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentEvent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * The morphedByMany assets relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assets()
    {
        return $this->morphedByMany(Asset::class, 'eventable')->withTimestamps();
    }

    /**
     * The morphedByMany inventories relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function inventories()
    {
        return $this->morphedByMany(Inventory::class, 'eventable')->withTimestamps();
    }

    /**
     * The morphedByMany work orders relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function workOrders()
    {
        return $this->morphedByMany(WorkOrder::class, 'eventable')->withTimestamps();
    }
}
