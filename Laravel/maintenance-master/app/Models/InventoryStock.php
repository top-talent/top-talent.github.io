<?php

namespace App\Models;

use App\Models\Traits\HasLocationTrait;
use App\Models\Traits\HasUserTrait;
use App\Viewers\Inventory\InventoryStockViewer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Inventory\Traits\InventoryStockTrait;

class InventoryStock extends Model
{
    use SoftDeletes;

    use InventoryStockTrait;
    use HasUserTrait;
    use HasLocationTrait;

    /**
     * The database table to store inventory stock records.
     *
     * @var string
     */
    protected $table = 'inventory_stocks';

    /**
     * The fillable eloquent attribute array for allowing mass assignments.
     *
     * @var array
     */
    protected $fillable = [
        'inventory_id',
        'location_id',
        'quantity',
        'aisle',
        'row',
        'bin',
    ];

    /**
     * The columns to keep revisions of.
     *
     * @var array
     */
    protected $revisionColumns = [
        'location_id',
        'aisle',
        'row',
        'bin',
    ];

    /**
     * The revisionable formatted field names.
     *
     * @var array
     */
    protected $revisionColumnsFormatted = [
        'location_id' => 'Location',
        'quantity'    => 'Quantity',
    ];

    /**
     * The inventory stock viewer class.
     *
     * @var string
     */
    protected $viewer = InventoryStockViewer::class;

    /*
    * The belongsTo item relationship.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */

    public function item()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'id');
    }

    /**
     * The hasOne location relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    /**
     * The hasMany transactions relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(InventoryTransaction::class, 'stock_id', 'id');
    }

    /**
     * The hasMany movements relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movements()
    {
        return $this->hasMany(InventoryStockMovement::class, 'stock_id')->latest();
    }

    /**
     * Accessor for viewing the last movement of the stock.
     *
     * @return null|string
     */
    public function getLastMovementAttribute()
    {
        if ($this->movements->count() > 0) {
            $movement = $this->movements->first();

            if ($movement instanceof InventoryStockMovement
                && $movement->after > $movement->before) {
                return sprintf('<b>%s</b> (Stock was added - %s) - <b>Reason:</b> %s', $movement->change, $movement->created_at, $movement->reason);
            } elseif ($movement->before > $movement->after) {
                return sprintf('<b>%s</b> (Stock was removed - %s) - <b>Reason:</b> %s', $movement->change, $movement->created_at, $movement->reason);
            } else {
                return sprintf('<b>%s</b> (No Change - %s) - <b>Reason:</b> %s', $movement->change, $movement->created_at, $movement->reason);
            }
        }

        return;
    }

    /**
     * Accessor for viewing the user responsible for the last
     * movement.
     *
     * @return null|string
     */
    public function getLastMovementByAttribute()
    {
        if ($this->movements->count() > 0) {
            $movement = $this->movements->first();

            if ($movement instanceof InventoryStockMovement
                && $movement->user instanceof User) {
                return $movement->user->getRecipientName();
            }
        }

        return;
    }

    /**
     * Accessor for viewing the quantity combined with the item metric.
     *
     * @return string
     */
    public function getQuantityMetricAttribute()
    {
        $quantity = $this->getAttribute('quantity');

        if ($this->item && $this->item->metric) {
            $metric = $this->item->metric->name;
        } else {
            $metric = null;
        }

        return trim(sprintf('%s %s', $quantity, $metric));
    }
}
