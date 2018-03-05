<?php

namespace App\Models;

use App\Models\Traits\HasUserTrait;
use App\Viewers\Inventory\InventoryStockMovementViewer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Inventory\Traits\InventoryStockMovementTrait;

class InventoryStockMovement extends Model
{
    use SoftDeletes;

    use InventoryStockMovementTrait;

    use HasUserTrait;

    /**
     * The inventory stock movements table.
     *
     * @var string
     */
    protected $table = 'inventory_stock_movements';

    /**
     * The fillable inventory stock movement attributes.
     *
     * @var array
     */
    protected $fillable = [
        'stock_id',
        'user_id',
        'before',
        'after',
        'cost',
        'reason',
    ];

    /**
     * The inventory stock movement viewer.
     *
     * @var string
     */
    protected $viewer = InventoryStockMovementViewer::class;

    /**
     * The belongsTo stock relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stock()
    {
        return $this->belongsTo(InventoryStock::class, 'stock_id', 'id');
    }

    /**
     * Returns the cost of the movement. If no cost is available it will return 0.00.
     *
     * @param int|string $cost
     *
     * @return string
     */
    public function getCostAttribute($cost)
    {
        if ($cost === null) {
            return '0.00';
        }

        return $cost;
    }

    /**
     * Returns the change of a stock.
     *
     * For example: '+ 25' or '- 25'
     *
     * @return string
     */
    public function getChangeAttribute()
    {
        if ($this->before > $this->after) {
            return sprintf('- %s', $this->before - $this->after);
        } elseif ($this->after > $this->before) {
            return sprintf('+ %s', $this->after - $this->before);
        } else {
            return 'None';
        }
    }
}
